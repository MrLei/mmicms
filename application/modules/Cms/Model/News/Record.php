<?php

class Cms_Model_News_Record extends Mmi_Dao_Record {

	public $id;
	public $lang;
	public $title;
	public $lead;
	public $text;
	public $dateAdd;
	public $dateModify;
	public $uri;
	public $internal;
	public $visible;

	public function save() {
		$filter = new Mmi_Filter_Url();
		$uri = $filter->filter($this->title);
		//identyfikatory dla linków wewnętrznych
		if ($this->internal == 1) {
			$exists = Cms_Model_News_Dao::byUriQuery($uri)
				->findFirst();
			if ($exists !== null && $exists->getPk() != $this->getPk()) {
				$uri = $uri . '_' . date('Y-m-d');
			}
			$this->uri = $uri;
		}
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::save();
	}

	public function getFirstImage() {
		return Cms_Model_File_Dao::imagesByObjectQuery('cmsnews', $this->id)
				->findFirst();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		Cms_Model_File_Dao::imagesByObjectQuery('cmsnews', $this->getPk())
			->find()
			->delete();
		return parent::delete();
	}

}
