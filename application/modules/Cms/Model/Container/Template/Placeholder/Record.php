<?php

class Cms_Model_Container_Template_Placeholder_Record extends Mmi_Dao_Record {

	public $id;
	public $cms_container_template_id;
	public $placeholder;
	public $name;

	public function save() {
		try {
			return parent::save();
		} catch (Exception $e) {
			return false;
		}
	}

}
