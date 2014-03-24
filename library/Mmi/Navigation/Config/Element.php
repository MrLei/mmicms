<?php

class Mmi_Navigation_Config_Element {

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
		'https' => false,
		'absolute' => false,
		'independent' => false,
		'nofollow' => false,
		'blank' => false,
		'dateStart' => null,
		'dateEnd' => null,
		'children' => array(),
	);

	public function __construct() {
		$this->_data['id'] = Mmi_Navigation_Config::getIndex();
	}

	public function getId() {
		return $this->_data['id'];
	}

	public function setLang($lang) {
		$this->data['lang'] = $lang;
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
	 * @param Mmi_Navigation_Config_Element $element
	 * @return Mmi_Navigation_Config_Element
	 */
	public function addChild(Mmi_Navigation_Config_Element $element) {
		$this->_data['children'][$element->getId()] = $element;
		return $this;
	}

	public function toArray() {
		$data = $this->_data;
		$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$view = Mmi_Controller_Front::getInstance()->getView();
		$data['disabled'] = false;
		if ($data['disabled'] || ($data['dateStart'] !== null && $data['dateStart'] > date('Y-m-d H:i:s')) || ($data['dateEnd'] !== null && $data['dateEnd'] < date('Y-m-d H:i:s'))) {
			$data['disabled'] = true;
		}
		$data['active'] = 0;
		if (!$this->_data['uri']) {
			$params = $this->_data['params'];
			if ($lang !== null && $this->_data['lang'] !== null) {
				$params['lang'] = $this->_data['lang'];
			}
			if ($this->_data['module'] != '') {
				$data['type'] = 'cms';
			} else {
				$data['type'] = 'folder';
			}
			$params['module'] = $this->_data['module'];
			$params['controller'] = $this->_data['controller'] ? $this->_data['controller'] : 'index';
			$params['action'] = $this->_data['action'] ? $this->_data['action'] : 'index';
			$https = null;
			if (array_key_exists('https', $this->_data) && $this->_data['https'] == 1) {
				$https = true;
			}
			if (array_key_exists('https', $this->_data) && $this->_data['https'] == 0) {
				$https = false;
			}
			$absolute = (isset($this->_data['absolute']) && $this->_data['absolute']) ? true : false;
			if ($this->_data['module'] != '') {
				$data['uri'] = $view->url($params, true, $absolute, $https);
			} else {
				$data['uri'] = '#';
			}
			$data['request'] = $params;
		} else {
			if (strpos($data['uri'], '://') === false && strpos($data['uri'], '#') !== 0 && strpos($data['uri'], '/') !== 0) {
				$data['uri'] = 'http://' . $data['uri'];
			}
			$data['type'] = 'link';
		}

		if ($this->_data['uri'] == null && $this->_data['module'] == null && $this->_data['controller'] == null && $this->_data['action'] == null) {
			$data['type'] = 'folder';
		} elseif ($this->_data['uri'] != null) {
			$data['type'] = 'link';
		} elseif ($this->_data['module'] == 'cms' && $this->_data['controller'] == 'article' && $this->_data['action'] == 'index') {
			$data['type'] = 'simple';
		} elseif ($this->_data['module'] == 'cms' && $this->_data['controller'] == 'container' && $this->_data['action'] == 'display') {
			$data['type'] = 'container';
		} else {
			$data['type'] = 'cms';
		}

		if (isset($data['children']) && !empty($data['children'])) {
			$children = array();
			foreach ($data['children'] as $child) {
				$childArray = $child->toArray();
				$children[$childArray['id']] = $childArray;
			}
			$data['children'] = $children;
		}
		return $data;
	}

}
