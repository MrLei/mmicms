<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
		
		//pobieranie elementu nawigacji
		$navigationRecord = $this->cmsNavigationId ? \Cms\Model\Navigation\Query::factory()->findPk($this->cmsNavigationId) : null;
		//jeśli nie pobrano - nowy
		if ($navigationRecord === null) {
			$navigationRecord = new \Cms\Model\Navigation\Record();
		}
		//ustawianie opcji elementu
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

		//pobieranie routy
		$routeRecord = $this->cmsRouteId ? \Cms\Model\Route\Query::factory()->findPk($this->cmsRouteId) : null;
		//jeśli nie pobrano
		if ($routeRecord === null) {
			$routeRecord = new \Cms\Model\Route\Record();
		}
		//ustawianie routy
		$routeRecord->active = $this->active;
		$routeRecord->pattern = $this->getOption('address');
		$routeRecord->save();

		//przypisanie routy i elementu nawigacji
		$this->cmsNavigationId = $navigationRecord->id;
		$this->cmsRouteId = $routeRecord->id;
		//ustawienie właściciela
		$this->cmsAuthId = \Core\Registry::$auth->getId();
		$this->save();
		
		//zapis do rekordu nawigacji parametru ID strony
		$navigationRecord->params = 'id=' . $this->id;
		if (!$navigationRecord->order) {
			$navigationRecord->order = 10000;
		}
		
		//zapis do rekordu routy ID
		$routeRecord->replace = 'module=cms&controller=page&action=index&id=' . $this->id;
		if (!$routeRecord->order) {
			$routeRecord->order = 10000;
		}
		//zapis elementu nawigacyjnego i routy
		return $navigationRecord->save() && $routeRecord->save();
	}

	/**
	 * Usuwanie rekordu
	 * @return boolean
	 */
	public function delete() {
		//uwsuwanie standardowego rekordu
		if (!parent::delete()) {
			return false;
		}
		//usuwa powiązany element nawigacyjny
		$navigationRecord = \Cms\Model\Navigation\Query::factory()->findPk($this->cmsNavigationId);
		$navigationRecord !== null && $navigationRecord->delete();
		//usuwa powiązaną routę
		$routeRecord = \Cms\Model\Route\Query::factory()->findPk($this->cmsRouteId);
		$routeRecord !== null && $routeRecord->delete();
		return true;
	}

	/**
	 * Ustawia datę dodania
	 * @return boolean
	 */
	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	/**
	 * Ustawia datę modyfikacji
	 * @return boolean
	 */
	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

}
