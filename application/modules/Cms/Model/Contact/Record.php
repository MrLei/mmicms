<?php

class Cms_Model_Contact_Record extends Mmi_Dao_Record {

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
		$this->ip = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
		$this->active = 1;
		$auth = Default_Registry::$auth;
		if ($auth->hasIdentity()) {
			$this->cms_auth_id = $auth->getId();
		}
		$namespace = new Mmi_Session_Namespace('contact');
		$this->uri = $namespace->referer;
		//wysyłka do maila zdefiniowanego w opcjach
		$option = new Cms_Model_Contact_Option_Record($this->cms_contact_option_id);
		if ($option->sendTo) {
			Mail_Model_Dao::pushEmail('admin_cms_contact', $option->sendTo, array('contact' => $this), null, $this->email);
		}
		return parent::_insert();
	}

	public function reply() {
		Mail_Model_Dao::pushEmail('contact_reply', $this->email, array(
			'id' => $this->id,
			'text' => $this->text,
			'replyText' => $this->reply
		));
		$this->active = 0;
		$this->cms_auth_id_reply = Default_Registry::$auth->getId();
		return $this->save();
	}

}
