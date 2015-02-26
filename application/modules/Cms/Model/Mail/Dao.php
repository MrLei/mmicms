<?php

namespace Cms\Model\Mail;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_mail';

	/**
	 * Czyści wysłane starsze niż tydzień
	 * @return int ilość usuniętych
	 */
	public static function clean() {
		return \Cms\Model\Mail\Query::factory()
				->whereActive()->equals(1)
				->andFieldDateAdd()->less(date('Y-m-d H:i:s', strtotime('-1 week')))
				->find()
				->delete();
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
		$def = \Cms\Model\Mail\Definition\Dao::langByNameQuery($name)
			->findFirst();
		if ($def === null) {
			return false;
		}
		$email = new \Mmi\Validate\EmailAddress();
		if (!$email->isValid($to)) {
			return false;
		}
		$mail = new \Cms\Model\Mail\Record();
		$mail->mailDefinitionId = $def->id;
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
				'type' => \Mmi\Lib::mimeType($filePath)
			);
		}
		$mail->setOption('attachments', serialize($tmpFiles));
		$view = \Mmi\Controller\Front::getInstance()->getView();
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

		$emails = \Cms\Model\Mail\Query::factory()
			->join('cms_mail_definition')->on('cms_mail_definition_id')
			->join('cms_mail_server', 'cms_mail_definition')->on('cms_mail_server_id')
			->whereActive()->equals(0)
			->andFieldDateSendAfter()->lessOrEquals(date('Y-m-d H:i:s'))
			->orderAscDateSendAfter()
			->find();

		if (count($emails) == 0) {
			return $result;
		}
		$transport = array();
		foreach ($emails as $email) {
			$config = array('port' => $email->getJoined('cms_mail_server')->port);
			if ($email->getJoined('cms_mail_server')->username && $email->getJoined('cms_mail_server')->password) {
				$config['auth'] = 'login';
				$config['username'] = $email->getJoined('cms_mail_server')->username;
				$config['password'] = $email->getJoined('cms_mail_server')->password;
			}
			if ($email->getJoined('mail_server')->ssl != 'plain') {
				$config['ssl'] = $email->getJoined('mail_server')->ssl;
			}
			if (!isset($transport[$email->getOption('mailServerId')])) {
				//@TODO: przepisać do ZF2
				$transport[$email->getOption('mailServerId')] = new Zend_Mail\Transport\Smtp($email->getJoined('cms_mail_server')->address, $config);
			}
			//@TODO: przepisać do ZF2
			$mail = new Zend_Mail('utf-8');
			$mail->setBodyText(strip_tags($email->message));
			if ($email->getJoined('cms_mail_definition')->html) {
				$mail->setBodyHtml($email->message);
			}
			$mail->setFrom($email->getJoined('cms_mail_server')->from, $email->fromName);
			$mail->addTo($email->to);
			if ($email->replyTo) {
				$mail->setReplyTo($email->replyTo);
			}
			$mail->setSubject($email->subject);
			$attachments = unserialize($email->getOption('attachments'));
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
				if ($mail->send($transport[$email->getOption('mailServerId')])) {
					$email->active = 1;
					$email->dateSent = date('Y-m-d H:i:s');
					$email->save();
				}
				$result['success'] ++;
			} catch (Exception $e) {
				\Mmi\Exception\Logger::log($e);
				$result['error'] ++;
			}
		}
		return $result;
	}

}
