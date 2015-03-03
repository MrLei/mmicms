<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\News;

class Record extends \Mmi\Dao\Record {

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
		$filter = new \Mmi\Filter\Url();
		$uri = $filter->filter($this->title);
		//identyfikatory dla linków wewnętrznych
		if ($this->internal == 1) {
			$exists = \Cms\Model\News\Dao::byUriQuery($uri)
				->findFirst();
			if ($exists !== null && $exists->getPk() != $this->getPk()) {
				$uri = $uri . '_' . date('Y-m-d');
			}
			$this->uri = $uri;
		}
		$this->lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::save();
	}

	public function getFirstImage() {
		return \Cms\Model\File\Dao::imagesByObjectQuery('cmsnews', $this->id)
				->findFirst();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		\Cms\Model\File\Dao::imagesByObjectQuery('cmsnews', $this->getPk())
			->find()
			->delete();
		return parent::delete();
	}

}
