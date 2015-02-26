<?php

namespace Cms\Model\Stat\Label;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $lang;
	public $object;
	public $label;
	public $description;

	protected function _insert() {
		$this->lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		return parent::_insert();
	}

}
