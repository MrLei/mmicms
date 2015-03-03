<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Widget\Picture;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $dateAdd;

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		\Cms\Model\File\Dao::imagesByObjectQuery('cmswidgetpicture', $this->getPk())
			->find()
			->delete();
		return parent::delete();
	}

	public function getFirstImage() {
		$image = \Cms\Model\File\Dao::imagesByObjectQuery('cmswidgetpicture', $this->id)
			->findFirst();
		return $image;
	}

}
