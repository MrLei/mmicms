<?php

/**
 * @property integer $id
 * @property string $lang
 * @property integer $parent_id
 * @property integer $order
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $params
 * @property string $label
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $uri
 * @property integer $visible
 * @property integer $https
 * @property integer $absolute
 * @property integer $independent
 * @property integer $nofollow
 * @property integer $blank
 * @property string $dateStart
 * @property string $dateEnd
 * @property integer $active
 */
class Cms_Model_Navigation_Record extends Mmi_Dao_Record {

	public function init() {
		$this->module = $this->module ? $this->module : 'default';
		$this->controller = $this->controller ? $this->controller : 'index';
		$this->action = $this->action ? $this->action : 'index';
		$this->object = $this->module . '_' . $this->controller . '_' . $this->action;
		if ($this->module == 'cms' && $this->controller == 'article' && $this->action == 'index') {
			parse_str($this->params, $params);
			if (!isset($params['uri']) || !$params['uri']) {
				return $this;
			}

			$article = Cms_Model_Article_Dao::findFirstByUri($params['uri']);
			if ($article !== null) {
				$this->article_id = $article->id;
			}
		}
		if ($this->module == 'cms' && $this->controller == 'container' && $this->action == 'index') {
			parse_str($this->params, $params);
			if (!isset($params['uri']) || !$params['uri']) {
				return $this;
			}
			$container = Cms_Model_Container_Dao::findFirstByUri($params['uri']);
			if ($container !== null) {
				$this->container_id = $container->id;
			}
		}
	}

	public function saveForm() {
		//ustawianie domyślnego języka
		if (!$this->lang) {
			$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
			$this->lang = $lang;
		}

		//konwersja obiektu na moduł/kontroler/akcja
		if ($this->object) {
			$params = explode('_', $this->object);
			if (count($params) == 3) {
				$this->module = $params[0];
				$this->controller = $params[1];
				$this->action = $params[2];
				$this->uri = null;
			}
			unset($this->object);
		}

		//wiązanie artykułu
		if ($this->article_id) {
			$article = new Cms_Model_Article_Record($this->article_id);
			$this->module = 'cms';
			$this->controller = 'article';
			$this->action = 'index';
			$this->params = 'uri=' . $article->uri;
			$this->uri = null;
		}

		//wiązanie kontenera
		if ($this->container_id) {
			$container = new Cms_Model_Container_Record($this->container_id);
			$this->module = 'cms';
			$this->controller = 'container';
			$this->action = 'index';
			$this->params = 'uri=' . $container->uri;
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
		if ($this->parent_id) {
			$lastElement = Cms_Model_Navigation_Dao::findLastByParentId($this->parent_id);
			$this->order = 0;
			if ($lastElement !== null) {
				$this->order = $lastElement->order + 1;
			}
		}
		return parent::_insert();
	}

	public function delete() {
		Cms_Model_Navigation_Dao::findByParentId($this->id)->delete();
		$this->_clearCache();
		return parent::delete();
	}

	protected function _clearCache() {
		Default_Registry::$cache->remove('Mmi_Navigation_' . Mmi_Controller_Front::getInstance()->getRequest()->lang);
		Default_Registry::$cache->remove('Mmi_Acl');
	}

}