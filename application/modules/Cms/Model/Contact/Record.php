<?php

/**
 * @property integer $id
 * @property integer $cms_contact_option_id
 * @property string $dateAdd
 * @property string $text
 * @property string $reply
 * @property integer $cms_auth_id_reply
 * @property string $uri
 * @property string $email
 * @property string $ip
 * @property integer $cms_auth_id
 * @property integer $active
 * @property string $name
 * @property string $phone
 */
class Cms_Model_Contact_Record extends Mmi_Dao_Record {

	public function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$this->ip = $_SERVER['REMOTE_ADDR'];
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