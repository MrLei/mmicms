<?php

/**
 * @property integer $id
 * @property string $lang
 * @property string $object
 * @property string $label
 * @property string $description
 */
class Stat_Model_Label_Record extends Mmi_Dao_Record {

	protected function _insert() {
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		return parent::_insert();
	}

}