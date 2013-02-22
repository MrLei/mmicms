<?php

class Cms_Model_Article_Record extends Mmi_Dao_Record {

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$filter = new Mmi_Filter_Url();
		$this->uri = $filter->filter($this->title);
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$result = parent::save();
		Mmi_Cache::getInstance()->remove('Cms_Article_' . $this->uri);
		return $result;
	}

	public function delete() {
		$article = Cms_Model_Navigation_Dao::findFirst(array(
				array('module', 'cms'),
				array('controller', 'article'),
				array('action', 'index'),
				array('params', 'uri=' . $this->uri)
		));
		if ($article !== null) {
			$article->delete();
		}
		return parent::delete();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}