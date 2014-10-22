<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $text
 */
class Cms_Model_Container_Template_Record extends Mmi_Dao_Record {
	
	public function save() {
		$uf = new Mmi_Filter_Url();
		$this->path = DATA_PATH . '/cms-page-template-' . $uf->filter($this->name) . '.tpl';
		file_put_contents($this->path, $this->text);
		foreach (glob(TMP_PATH . '/compile/*.php') as $compilant) {
			unlink($compilant);
		}
		return parent::save();
	}
	
}