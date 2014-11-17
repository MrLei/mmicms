<?php

class Mail_Model_Definition_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $lang;

	/**
	 *
	 * @var integer
	 */
	public $mail_server_id;

	/**
	 *
	 * @var string
	 */
	public $name;

	/**
	 *
	 * @var string
	 */
	public $replyTo;

	/**
	 *
	 * @var string
	 */
	public $fromName;

	/**
	 *
	 * @var string
	 */
	public $subject;

	/**
	 *
	 * @var string
	 */
	public $message;

	/**
	 *
	 * @var integer
	 */
	public $html;

	/**
	 *
	 * @var string
	 */
	public $dateAdd;

	/**
	 *
	 * @var string
	 */
	public $dateModify;

	/**
	 *
	 * @var integer
	 */
	public $active;

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}
