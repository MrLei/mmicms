<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Contact;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $cmsContactOptionId;
	public $dateAdd;
	public $text;
	public $reply;
	public $cmsAuthIdReply;
	public $uri;
	public $email;
	public $ip;
	public $cmsAuthId;
	public $active;
	public $name;
	public $phone;

	public function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$this->ip = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		$this->active = 1;
		$auth = \Core\Registry::$auth;
		if ($auth->hasIdentity()) {
			$this->cmsAuthId = $auth->getId();
		}
		$namespace = new \Mmi\Session\Space('contact');
		$this->uri = $namespace->referer;
		//wysyłka do maila zdefiniowanego w opcjach
		$option = \Cms\Model\Contact\Option\Query::factory()->findPk($this->cmsContactOptionId);
		if (!$option) {
			return false;
		}
		Mail\Model\Dao::pushEmail('admin_cms_contact', $option->sendTo, array('contact' => $this), null, $this->email);
		return parent::_insert();
	}

	public function reply() {
		Mail\Model\Dao::pushEmail('contact_reply', $this->email, array(
			'id' => $this->id,
			'text' => $this->text,
			'replyText' => $this->reply
		));
		$this->active = 0;
		$this->cmsAuthIdReply = \Core\Registry::$auth->getId();
		return $this->save();
	}

}
