<?php

namespace Cms\Model\Page;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $name;
	public $cmsNavigationId;
	public $cmsRouteId;
	public $text;
	public $active;
	public $dateAdd;
	public $dateModify;
	public $cmsAuthId;

	public function saveForm() {
		$navigationRecord = $this->cmsNavigationId ? \Cms\Model\Navigation\Query::factory()->findPk($this->cmsNavigationId) : null;
		/* @var $navigationRecord \Cms\Model\Navigation\Record */
		$navigationRecord = ($navigationRecord === null) ? new \Cms\Model\Navigation\Record() : $navigationRecord;

		$navigationRecord->absolute = 0;
		$navigationRecord->action = 'index';
		$navigationRecord->active = 1;
		$navigationRecord->blank = 0;
		$navigationRecord->controller = 'page';
		$navigationRecord->description = $this->getOption('description');
		$navigationRecord->https = 0;
		$navigationRecord->independent = 1;
		$navigationRecord->label = $this->name;
		$navigationRecord->module = 'cms';
		$navigationRecord->nofollow = 0;
		$navigationRecord->title = $this->getOption('title');
		$navigationRecord->visible = 0;
		$navigationRecord->save();

		$routeRecord = $this->cmsRouteId ? \Cms\Model\Route\Query::factory()->findPk($this->cmsRouteId) : null;
		/* @var $routeRecord \Cms\Model\Route\Record */
		$routeRecord = ($routeRecord === null) ? new \Cms\Model\Route\Record() : $routeRecord;
		$routeRecord->active = $this->active;
		$routeRecord->pattern = $this->getOption('address');
		$routeRecord->save();

		$this->cmsNavigationId = $navigationRecord->id;
		$this->cmsRouteId = $routeRecord->id;
		$this->cmsAuthId = \Core\Registry::$auth->getId();
		$this->save();
		$navigationRecord->params = 'id=' . $this->id;
		if (!$navigationRecord->order) {
			$navigationRecord->order = 10000;
		}
		$routeRecord->replace = 'module=cms&controller=page&action=index&id=' . $this->id;
		if (!$routeRecord->order) {
			$routeRecord->order = 10000;
		}
		return $navigationRecord->save() && $routeRecord->save();
	}

	public function delete() {
		if (!parent::delete()) {
			return false;
		}
		$navigationRecord = \Cms\Model\Navigation\Query::factory()->findPk($this->cmsNavigationId);
		if ($navigationRecord !== null) {
			$navigationRecord->delete();
		}
		$routeRecord = \Cms\Model\Route\Query::factory()->findPk($this->cmsRouteId);
		if ($routeRecord !== null) {
			$routeRecord->delete();
		}
		return true;
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

}
