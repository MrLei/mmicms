<?php

class Cms_Model_Widget_Picture_Record extends Mmi_Dao_Record {

	public $id;
	public $dateAdd;

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		Cms_Model_File_Dao::imagesByObjectQuery('cmswidgetpicture', $this->getPk())
			->find()
			->delete();
		return parent::delete();
	}

	public function getFirstImage() {
		$image = Cms_Model_File_Dao::imagesByObjectQuery('cmswidgetpicture', $this->id)
			->findFirst();
		return $image;
	}

}
