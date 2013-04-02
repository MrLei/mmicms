<?php
class News_Model_Record extends Mmi_Dao_Record {

	public function save() {
		$filter = new Mmi_Filter_Url();
		$uri = $filter->filter($this->title);
		//identyfikatory dla linków wewnętrznych
		if ($this->internal == 1) {
			$exists = News_Model_Dao::findFirst(array('uri', $uri));
			if ($exists !== null && $exists->getId() != $this->getId()) {
				$uri = $uri . '_' . date('Y-m-d');
			}
			$this->uri = $uri;
		}
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::save();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		$files = new Cms_Model_File();
		$files->deleteAll(array(
			array('object', 'news'),
			array('objectId', $this->getId())
		));
		return parent::delete();
	}

}