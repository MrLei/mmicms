<?php

class Stat_Model_Label_Record extends Mmi_Dao_Record {

	public $id;
	public $lang;
	public $object;
	public $label;
	public $description;

	protected function _insert() {
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		return parent::_insert();
	}

}
