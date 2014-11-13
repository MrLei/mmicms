<?php

class Cms_Model_Container_Template_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $name;

	/**
	 *
	 * @var string
	 */
	public $path;

	/**
	 *
	 * @var string
	 */
	public $text;
	
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