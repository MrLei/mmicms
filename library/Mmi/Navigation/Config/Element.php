<?php

namespace Mmi\Navigation\Config;

class Element {

	protected $_data = array(
		'id' => null,
		'lang' => null,
		'disabled' => false,
		'visible' => true,
		'label' => null,
		'module' => null,
		'controller' => 'index',
		'action' => 'index',
		'params' => array(),
		'title' => null,
		'keywords' => null,
		'description' => null,
		'uri' => null,
		'https' => null,
		'absolute' => false,
		'independent' => false,
		'nofollow' => false,
		'blank' => false,
		'dateStart' => null,
		'dateEnd' => null,
		'type' => 'cms',
		'children' => array(),
	);
	protected $_built = array();

	public function __construct($id = null) {
		$this->_data['id'] = ($id === null) ? \Mmi\Navigation\Config::getAutoIndex() : $id;
	}

	public function getId() {
		return $this->_data['id'];
	}

	public function getChildren() {
		return $this->_data['children'];
	}

	public function setLang($lang) {
		$this->_data['lang'] = $lang;
		return $this;
	}

	public function setDisabled($disabled = true) {
		$this->_data['disabled'] = $disabled ? true : false;
		return $this;
	}

	public function setVisible($visible = true) {
		$this->_data['visible'] = $visible ? true : false;
		return $this;
	}

	public function setLabel($label) {
		$this->_data['label'] = $label;
		return $this;
	}

	public function setModule($module) {
		$this->_data['module'] = $module;
		return $this;
	}

	public function setController($controller) {
		$this->_data['controller'] = $controller;
		return $this;
	}

	public function setAction($action) {
		$this->_data['action'] = $action;
		return $this;
	}

	public function setParams(array $params) {
		$this->_data['params'] = $params;
		return $this;
	}

	public function setTitle($title) {
		$this->_data['title'] = $title;
		return $this;
	}

	public function setKeywords($keywords) {
		$this->_data['keywords'] = $keywords;
		return $this;
	}

	public function setDescription($description) {
		$this->_data['description'] = $description;
		return $this;
	}

	public function setUri($uri) {
		$this->_data['uri'] = $uri;
		return $this;
	}

	public function setHttps($https = null) {
		if ($https === null) {
			$this->_data['https'] = null;
			return $this;
		}
		$this->_data['https'] = $https ? true : false;
		return $this;
	}

	public function setAbsolute($absolute = true) {
		$this->_data['absolute'] = $absolute ? true : false;
		return $this;
	}

	public function setIndependent($independent) {
		$this->_data['independent'] = $independent;
		return $this;
	}

	public function setNofollow($nofollow) {
		$this->_data['nofollow'] = $nofollow;
		return $this;
	}

	public function setBlank($blank) {
		$this->_data['blank'] = $blank;
		return $this;
	}

	public function setDateStart($dateStart) {
		$this->_data['dateStart'] = $dateStart;
		return $this;
	}

	public function setDateEnd($dateEnd) {
		$this->_data['dateEnd'] = $dateEnd;
		return $this;
	}

	/**
	 * Dodaje element potomny
	 * @param \Mmi\Navigation\Config\Element $element
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function addChild(\Mmi\Navigation\Config\Element $element) {
		$this->_data['children'][$element->getId()] = $element;
		return $this;
	}

	public function build() {
		$lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		$view = \Mmi\Controller\Front::getInstance()->getView();
		if ($this->_data['disabled'] || ($this->_data['dateStart'] !== null && $this->_data['dateStart'] > date('Y-m-d H:i:s')) || ($this->_data['dateEnd'] !== null && $this->_data['dateEnd'] < date('Y-m-d H:i:s'))) {
			$this->_data['disabled'] = true;
		}
		if (!$this->_data['uri']) {
			$params = $this->_data['params'];
			if ($lang !== null && $this->_data['lang'] !== null) {
				$params['lang'] = $this->_data['lang'];
			}
			$params['module'] = $this->_data['module'];
			$params['controller'] = $this->_data['controller'];
			$params['action'] = $this->_data['action'];
			if ($this->_data['module']) {
				$this->_data['uri'] = $view->url($params, true, $this->_data['absolute'], $this->_data['https']);
				if ($this->_data['module'] == 'cms' && $this->_data['controller'] == 'article' && $this->_data['action'] == 'index') {
					$this->_data['type'] = 'simple';
				} elseif ($this->_data['module'] == 'cms' && $this->_data['controller'] == 'container' && $this->_data['action'] == 'display') {
					$this->_data['type'] = 'container';
				}
			} else {
				$this->_data['uri'] = '#';
				$this->_data['type'] = 'folder';
			}
			$this->_data['request'] = $params;
		} else {
			if (strpos($this->_data['uri'], '://') === false && strpos($this->_data['uri'], '#') !== 0 && strpos($this->_data['uri'], '/') !== 0) {
				$this->_data['uri'] = 'http://' . $this->_data['uri'];
			}
			$this->_data['type'] = 'link';
		}
		$this->_built = $this->_data;
		$this->_built['children'] = array();

		if (!empty($this->_data['children'])) {
			foreach ($this->_data['children'] as $child) {
				$this->_built['children'][$child->getId()] = $child->build();
			}
		}
		return $this->_built;
	}

}
