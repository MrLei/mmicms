<?php

class Cms_Model_Container_Template_Record extends Mmi_Dao_Record {
	
	public function save() {
		$uf = new Mmi_Filter_Url();
		$this->path = DATA_PATH . '/cms-page-template-' . $uf->filter($this->name) . '.tpl';
		file_put_contents($this->path, $this->text);
		return parent::save();
	}
	
}