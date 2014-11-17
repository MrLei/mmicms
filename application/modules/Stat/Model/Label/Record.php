<?php

class Stat_Model_Label_Record extends Mmi_Dao_Record {

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
	 * @var string
	 */
	public $object;

	/**
	 *
	 * @var string
	 */
	public $label;

	/**
	 *
	 * @var string
	 */
	public $description;

	protected function _insert() {
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		return parent::_insert();
	}

}