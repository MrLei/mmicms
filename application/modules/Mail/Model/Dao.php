<?php

class Mail_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail';

	/**
	 * Czyści wysłane starsze niż tydzień
	 * @return int ilość usuniętych
	 */
	public static function clean() {
		$q = self::newQuery()
			->where('active')->equals(1)
			->andField('dateAdd')->less(date('Y-m-d H:i:s', strtotime('-1 week')));
		return self::find($q)->delete();
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
		$def = Mail_Model_Definition_Dao::findFirstLangByName($name);
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
		$view = Mmi_Controller_Front::getInstance()->getView();
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

		$q = self::newQuery()
			->join('mail_definition')->on('mail_definition_id')
			->join('mail_server', 'mail_definition')->on('mail_server_id')
			->where('active')->equals(0)
			->andField('dateSendAfter')->lessOrEquals(date('Y-m-d H:i:s'))
			->orderAsc('dateSendAfter');

		$emails = Mail_Model_Dao::find($q);
		if (count($emails) == 0) {
			return $result;
		}
		$transport = array();
		foreach ($emails as $email) {
			$config = array('port' => $email->mail_server->port);
			if ($email->mail_server->username && $email->mail_server->password) {
				$config['auth'] = 'login';
				$config['username'] = $email->mail_server->username;
				$config['password'] = $email->mail_server->password;
			}
			if ($email->mail_server->ssl != 'plain') {
				$config['ssl'] = $email->mail_server->ssl;
			}
			if (!isset($transport[$email->mail_server_id])) {
				//@TODO: przepisać do ZF2
				$transport[$email->mail_server_id] = new Zend_Mail_Transport_Smtp($email->mail_server->address, $config);
			}
			//@TODO: przepisać do ZF2
			$mail = new Zend_Mail('utf-8');
			$mail->setBodyText(strip_tags($email->message));
			if ($email->mail_definition->html) {
				$mail->setBodyHtml($email->message);
			}
			$mail->setFrom($email->mail_server->from, $email->fromName);
			$mail->addTo($email->to);
			if ($email->replyTo) {
				$mail->setReplyTo($email->replyTo);
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
				Mmi_Exception_Logger::log($e);
				$result['error']++;
			}
		}
		return $result;
	}

}