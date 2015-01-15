<?php

class Cms_Model_Page_Record extends Mmi_Dao_Record {

	public $id;
	public $name;
	public $cmsNavigationId;
	public $cmsRouteId;
	public $text;
	public $active;
	public $dateAdd;
	public $dateModify;
	
	public function saveForm() {
		$navigationRecord = $this->cmsNavigationId ? Cms_Model_Navigation_Dao::findPk($this->cmsNavigationId) : null;
		/* @var $navigationRecord Cms_Model_Navigation_Record */
		$navigationRecord = ($navigationRecord === null) ? new Cms_Model_Navigation_Record() : $navigationRecord;
		
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

		$routeRecord = $this->cmsRouteId ? Cms_Model_Navigation_Dao::findPk($this->cmsRouteId) : null;
		/* @var $routeRecord Cms_Model_Route_Record */
		$routeRecord = ($routeRecord === null) ? new Cms_Model_Route_Record() : $routeRecord;
		$routeRecord->active = $this->active;
		$routeRecord->pattern = $this->getOption('address');
		$routeRecord->save();
		
		
		$this->cmsNavigationId = $navigationRecord->id;
		$this->cmsRouteId = $routeRecord->id;
		$this->save();
		$navigationRecord->params = 'id=' . $this->id;
		$routeRecord->replace = 'module=cms&controller=page&action=index&id=' . $this->id;
		return $navigationRecord->save() && $routeRecord->save();
	}

}