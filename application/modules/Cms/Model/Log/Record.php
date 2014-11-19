<?php

class Cms_Model_Log_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $url;

	/**
	 *
	 * @var string
	 */
	public $ip;

	/**
	 *
	 * @var string
	 */
	public $browser;

	/**
	 *
	 * @var string
	 */
	public $operation;

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

	/**
	 *
	 * @var string
	 */
	public $data;

	/**
	 *
	 * @var integer
	 */
	public $success;

	/**
	 *
	 * @var integer
	 */
	public $cms_auth_id;

	/**
	 *
	 * @var string
	 */
	public $dateTime;

}
