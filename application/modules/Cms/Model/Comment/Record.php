<?php

class Cms_Model_Comment_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $cms;

	/**
	 *
	 * @var integer
	 */
	public $parent;

	/**
	 *
	 * @var string
	 */
	public $dateAdd;

	/**
	 *
	 * @var string
	 */
	public $title;

	/**
	 *
	 * @var string
	 */
	public $text;

	/**
	 *
	 * @var string
	 */
	public $signature;

	/**
	 *
	 * @var string
	 */
	public $ip;

	/**
	 *
	 * @var float
	 */
	public $stars;

	/**
	 *
	 * @var string
	 */
	public $object;

	/**
	 *
	 * @var integer
	 */
	public $objectId;

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$auth = Default_Registry::$auth;
		if ($auth->hasIdentity()) {
			$this->signature = $auth->getUsername();
			$this->cms_auth_id = $auth->getId();
		} else {
			$this->signature = '~' . $this->signature;
			$this->ip = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
		}
		return parent::_insert();
	}

}