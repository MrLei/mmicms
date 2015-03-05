<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Navigation\Config;

class Element {

	/**
	 * Dane elementu
	 * @var array
	 */
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

	/**
	 * Struktura drzewiasta
	 * @var array
	 */
	protected $_build = array();

	/**
	 * Konstruktor
	 * @param integer $id
	 */
	public function __construct($id = null) {
		$this->_data['id'] = ($id === null) ? \Mmi\Navigation\Config::getAutoIndex() : $id;
	}

	/**
	 * Pobieranie ID
	 * @return integer
	 */
	public function getId() {
		return $this->_data['id'];
	}

	/**
	 * Pobiera dzieci
	 * @return array
	 */
	public function getChildren() {
		return $this->_data['children'];
	}

	/**
	 * Ustawia język
	 * @param string $lang
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setLang($lang) {
		$this->_data['lang'] = $lang;
		return $this;
	}

	/**
	 * Wyłącza element
	 * @param boolean $disabled
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDisabled($disabled = true) {
		$this->_data['disabled'] = (bool) $disabled;
		return $this;
	}

	/**
	 * Ustawia widoczność
	 * @param boolean $visible
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setVisible($visible = true) {
		$this->_data['visible'] = (bool) $visible;
		return $this;
	}

	/**
	 * Ustawia labelkę
	 * @param string $label
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setLabel($label) {
		$this->_data['label'] = $label;
		return $this;
	}

	/**
	 * Ustawia moduł
	 * @param string $module
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setModule($module) {
		$this->_data['module'] = $module;
		return $this;
	}

	/**
	 * Ustawia kontroler
	 * @param string $controller
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setController($controller) {
		$this->_data['controller'] = $controller;
		return $this;
	}

	/**
	 * Ustawia akcję
	 * @param string $action
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setAction($action) {
		$this->_data['action'] = $action;
		return $this;
	}

	/**
	 * Ustawia parametry
	 * @param array $params
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setParams(array $params) {
		$this->_data['params'] = $params;
		return $this;
	}

	/**
	 * Ustawia tytuł
	 * @param string $title
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setTitle($title) {
		$this->_data['title'] = $title;
		return $this;
	}

	/**
	 * Ustawia keywords
	 * @param string $keywords
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setKeywords($keywords) {
		$this->_data['keywords'] = $keywords;
		return $this;
	}

	/**
	 * Ustawia opis
	 * @param string $description
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDescription($description) {
		$this->_data['description'] = $description;
		return $this;
	}

	/**
	 * Ustawia uri
	 * @param string $uri
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setUri($uri) {
		$this->_data['uri'] = $uri;
		return $this;
	}

	/**
	 * Ustawia HTTPS
	 * @param boolean $https
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setHttps($https = null) {
		if ($https === null) {
			$this->_data['https'] = null;
			return $this;
		}
		$this->_data['https'] = (bool) $https;
		return $this;
	}

	/**
	 * Ustawia typ linku na absolutny
	 * @param boolean $absolute
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setAbsolute($absolute = true) {
		$this->_data['absolute'] = (bool) $absolute;
		return $this;
	}

	/**
	 * Ustawia typ meta na niezależne
	 * @param boolean $independent
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setIndependent($independent = true) {
		$this->_data['independent'] = $independent;
		return $this;
	}

	/**
	 * Ustawia typ linku na nofollow
	 * @param boolean $nofollow
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setNofollow($nofollow = true) {
		$this->_data['nofollow'] = $nofollow;
		return $this;
	}

	/**
	 * Ustawia target linku na blank
	 * @param boolean $blank
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setBlank($blank = true) {
		$this->_data['blank'] = $blank;
		return $this;
	}

	/**
	 * Ustawia datę włączenia węzła
	 * @param string $dateStart
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDateStart($dateStart) {
		$this->_data['dateStart'] = $dateStart;
		return $this;
	}

	/**
	 * Ustawia datę wyłączenia węzła
	 * @param string $dateEnd
	 * @return \Mmi\Navigation\Config\Element
	 */
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

	/**
	 * Budowanie struktury drzewiastej na podstawie konfiguracji
	 * @return array
	 */
	public function build() {
		return ($this->_build = Builder::build($this->_data));
	}

}
