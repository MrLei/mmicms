<?php

class Cms_Model_Container_Template_Placeholder_Record extends Mmi_Dao_Record {

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
	 * @var string
	 */
	public $placeholder;

	/**
	 *
	 * @var string
	 */
	public $name;
	
	public function save() {
		try {
			return parent::save();
		} catch (Exception $e) {
			return false;
		}
	}
	
}