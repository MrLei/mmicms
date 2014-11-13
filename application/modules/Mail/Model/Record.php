<?php

class Mail_Model_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $mail;

	/**
	 *
	 * @var string
	 */
	public $fromName;

	/**
	 *
	 * @var string
	 */
	public $to;

	/**
	 *
	 * @var string
	 */
	public $replyTo;

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
	 * @var string
	 */
	public $attachements;

	/**
	 *
	 * @var integer
	 */
	public $type;

	/**
	 *
	 * @var string
	 */
	public $dateAdd;

	/**
	 *
	 * @var string
	 */
	public $dateSent;

	/**
	 *
	 * @var string
	 */
	public $dateSendAfter;

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
