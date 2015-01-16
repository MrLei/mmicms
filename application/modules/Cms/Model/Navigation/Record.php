<?php

class Cms_Model_Navigation_Record extends Mmi_Dao_Record {

	public $id;
	public $lang;
	public $parentId;
	public $order;
	public $module;
	public $controller;
	public $action;
	public $params;
	public $label;
	public $title;
	public $keywords;
	public $description;
	public $uri;
	public $visible;
	public $dateStart;
	public $dateEnd;
	public $absolute;
	public $independent;
	public $nofollow;
	public $blank;
	public $https;
	public $active;

	public function init() {
		$this->module = $this->module ? $this->module : 'default';
		$this->controller = $this->controller ? $this->controller : 'index';
		$this->action = $this->action ? $this->action : 'index';
		$this->setOption('object', $this->module . '_' . $this->controller . '_' . $this->action);
		if ($this->module == 'cms' && $this->controller == 'article' && $this->action == 'index') {
			parse_str($this->params, $params);
			if (!isset($params['uri']) || !$params['uri']) {
				return $this;
			}

			$article = Cms_Model_Article_Dao::byUriQuery($params['uri'])
				->findFirst();
			if ($article !== null) {
				$this->articleId = $article->id;
			}
		}
	}

	public function saveForm() {
		//ustawianie domyślnego języka
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		if ($this->parentId === null) {
			$this->parentId = 0;
		}
		//konwersja obiektu na moduł/kontroler/akcja
		if ($this->getOption('object')) {
			$params = explode('_', $this->getOption('object'));
			if (count($params) == 3) {
				$this->module = $params[0];
				$this->controller = $params[1];
				$this->action = $params[2];
				$this->uri = null;
			}
		}

		//wiązanie artykułu
		if ($this->getOption('article_id')) {
			$article = new Cms_Model_Article_Record($this->articleId);
			$this->module = 'cms';
			$this->controller = 'article';
			$this->action = 'index';
			$this->params = 'uri=' . $article->uri;
			$this->uri = null;
		}

		$this->dateStart = $this->dateStart ? $this->dateStart : null;
		$this->dateEnd = $this->dateEnd ? $this->dateEnd : null;

		return $this->save();
	}

	public function save() {
		$result = parent::save();
		$this->_clearCache();
		return $result;
	}

	public function _insert() {
		//dodawanie na końcu listy
		if ($this->parentId) {
			$lastElement = Cms_Model_Navigation_Dao::descByParentIdQuery($this->parentId)
				->findFirst();
			$this->order = 0;
			if ($lastElement !== null) {
				$this->order = $lastElement->order + 1;
			}
		}
		return parent::_insert();
	}

	public function delete() {
		Cms_Model_Navigation_Dao::byParentIdQuery($this->id)
			->find()
			->delete();
		$this->_clearCache();
		return parent::delete();
	}

	protected function _clearCache() {
		Default_Registry::$cache->remove('Mmi_Navigation_');
		Default_Registry::$cache->remove('Mmi_Navigation_' . Mmi_Controller_Front::getInstance()->getRequest()->lang);
		Default_Registry::$cache->remove('Mmi_Acl');
	}

}
