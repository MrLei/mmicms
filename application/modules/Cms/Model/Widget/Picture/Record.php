<?php


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
