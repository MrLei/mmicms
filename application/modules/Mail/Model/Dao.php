<?php

class Mail_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail';
	protected static $_definitionServerJoinSchema = array(
		'mail_definition' => array('id', 'mail_definition_id'),
		'mail_server' => array('id', 'mail_server_id', 'mail_definition')
	);

	/**
	 * Czyści wysłane starsze niż tydzień
	 * @return int ilość usuniętych
	 */
	public static function clean() {
		return self::find(array(
					array('active', 1),
					array('dateAdd', date('Y-m-d H:i:s', strtotime('-1 week')), '<')
				))->delete();
	}

	/**
	 * Dodaje email do kolejki
	 * @param string $name nazwa-klucz e-maila z definicji
	 * @param string $to adres do
	 * @param array $params zmienne do podstawienia w treści maila
	 * @param string $fromName nazwa od
	 * @param string $replyTo adres odpowiedz do
	 * @param string $subject temat
	 * @param string $sendAfter data i czas wyślij po
	 * @param array $attachments tabela z załącznikami w postaci array('nazwa dla usera' => 'fizyczna ścieżka i nazwa pliku')
	 * @return int id zapisanego rekordu
	 */
	public static function pushEmail($name, $to, array $params = array(), $fromName = null, $replyTo = null, $subject = null, $sendAfter = null, array $attachments = array()) {
		$def = Mail_Model_Definition_Dao::findFirst(array(
					array('name', $name),
					array('lang', Mmi_Controller_Front::getInstance()->getRequest()->lang)
				));
		if ($def === null) {
			return false;
		}
		$email = new Mmi_Validate_EmailAddress();
		if (!$email->isValid($to)) {
			return false;
		}
		$mail = new Mail_Model_Record();
		$mail->mail_definition_id = $def->id;
		$mail->to = $to;
		$mail->fromName = !(null === $fromName) ? $fromName : $def->fromName;
		$mail->replyTo = !(null === $replyTo) ? $replyTo : $def->replyTo;
		$mail->replyTo = (strlen($mail->replyTo) > 0) ? $mail->replyTo : null;
		$mail->subject = !(null === $subject) ? $subject : $def->subject;
		$mail->dateSendAfter = !(null === $sendAfter) ? $sendAfter : date('Y-m-d H:i:s');
		$tmpFiles = array();
		foreach ($attachments as $fileName => $filePath) {
			if (!file_exists($filePath)) {
				continue;
			}
			$tmpFiles[$fileName] = array('content' => base64_encode(file_get_contents($filePath)),
				'type' => Mmi_Lib::mimeType($filePath)
			);
		}
		$mail->attachments = serialize($tmpFiles);
		$view = Mmi_View::getInstance();
		foreach ($params as $key => $value) {
			$view->$key = $value;
		}
		$mail->message = $view->renderDirectly($def->message);
		$mail->subject = $view->renderDirectly($mail->subject);
		$mail->dateAdd = date('Y-m-d H:i:s');
		return $mail->save();
	}

	/**
	 * Wysyła maile z kolejki
	 * @return int ilość wysłanych
	 */
	public static function send() {
		$result = array('error' => 0, 'success' => 0);
		$emails = Mail_Model_Dao::find(array(
					array('active', 0),
					array('dateSendAfter', date('Y-m-d H:i:s'), '<=')
						), array(
					'dateSendAfter'
						), null, null, self::$_definitionServerJoinSchema
		);
		if (count($emails) == 0) {
			return $result;
		}
		$transport = array();
		foreach ($emails as $email) {
			$config = array('port' => $email->port);
			if ($email->username && $email->password) {
				$config['auth'] = 'login';
				$config['username'] = $email->username;
				$config['password'] = $email->password;
			}
			if ($email->ssl != 'plain') {
				$config['ssl'] = $email->ssl;
			}
			if (!isset($transport[$email->mail_server_id])) {
				//@TODO: przepisać do ZF2
				$transport[$email->mail_server_id] = new Zend_Mail_Transport_Smtp($email->address, $config);
			}
			//@TODO: przepisać do ZF2
			$mail = new Zend_Mail('utf-8');
			$mail->setBodyText(strip_tags($email->message));
			if ($email->html) {
				$mail->setBodyHtml($email->message);
			}
			$mail->setFrom($email->from, $email->fromName);
			$mail->addTo($email->to);
			if ($email->replyTo) {
				$mail->setReplyTo($email->replyTo);
			} else {
				$mail->setReplyTo($email->from);
			}
			$mail->setSubject($email->subject);
			$attachments = unserialize($email->attachments);
			if (!empty($attachments)) {
				foreach ($attachments as $fileName => $file) {
					if (!isset($file['content']) || !isset($file['type'])) {
						continue;
					}
					//@TODO: przepisać do ZF2
					$mail->createAttachment(base64_decode($file['content']), $file['type'], Zend_Mime::DISPOSITION_ATTACHMENT, Zend_Mime::ENCODING_BASE64, $fileName);
				}
			}
			try {
				if ($mail->send($transport[$email->mail_server_id])) {
					$record = new Mail_Model_Record();
					$record->setNew(false);
					$record->id = $email->id;
					$record->active = 1;
					$record->dateSent = date('Y-m-d H:i:s');
					$record->save();
				}
				$result['success']++;
			} catch (Exception $e) {
				Mmi_Controller_Front::getInstance()->getBootstrap()->logException($e);
				$result['error']++;
			}
		}
		return $result;
	}

}