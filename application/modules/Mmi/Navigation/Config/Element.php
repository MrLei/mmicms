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
		//id
		'id' => null,
		//język
		'lang' => null,
		//wyłączony
		'disabled' => false,
		//widoczny
		'visible' => true,
		//labelka
		'label' => null,
		//moduł + kontroler + akcja + parametry
		'module' => null,
		'controller' => 'index',
		'action' => 'index',
		'params' => array(),
		//tytuł
		'title' => null,
		//keywords
		'keywords' => null,
		//opis
		'description' => null,
		//uri
		'uri' => null,
		//czy https
		'https' => null,
		//czy absolutny
		'absolute' => false,
		//czy niezależne meta
		'independent' => false,
		//czy nofollow
		'nofollow' => false,
		//czy blank
		'blank' => false,
		//data rozpoczęcia publikacji
		'dateStart' => null,
		//data wyłączenia publikacji
		'dateEnd' => null,
		//typ
		'type' => 'cms',
		//tabela z elementami potomnymi
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
	 * Pobiera wartość
	 * @param string $name
	 * @return mixed
	 */
	public function get($name) {
		return isset($this->_data[$name]) ? $this->_data[$name] : null;
	}

	/**
	 * Ustawia wartość
	 * @param string $name
	 * @param string $value
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function set($name, $value) {
		$this->_data[$name] = $value;
		return $this;
	}

	/**
	 * Pobieranie ID
	 * @return integer
	 */
	public function getId() {
		return $this->get('id');
	}
	
	/**
	 * Ustawia ID
	 * @param integer $id
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setId($id) {
		return $this->set('id', $id);
	}

	/**
	 * Pobiera dzieci
	 * @return array
	 */
	public function getChildren() {
		return $this->get('children');
	}
	
	/**
	 * Ustawia język
	 * @param string $lang
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setLang($lang) {
		return $this->set('lang', $lang);
	}

	/**
	 * Wyłącza element
	 * @param boolean $disabled
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDisabled($disabled = true) {
		return $this->set('disabled', (bool) $disabled);
	}

	/**
	 * Ustawia widoczność
	 * @param boolean $visible
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setVisible($visible = true) {
		return $this->set('visible', (bool) $visible);
	}

	/**
	 * Ustawia labelkę
	 * @param string $label
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setLabel($label) {
		return $this->set('label', $label);
	}

	/**
	 * Ustawia moduł
	 * @param string $module
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setModule($module) {
		return $this->set('module', $module);
	}

	/**
	 * Ustawia kontroler
	 * @param string $controller
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setController($controller) {
		return $this->set('controller', $controller);
	}

	/**
	 * Ustawia akcję
	 * @param string $action
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setAction($action) {
		return $this->set('action', $action);
	}

	/**
	 * Ustawia parametry
	 * @param array $params
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setParams(array $params) {
		return $this->set('params', $params);
	}

	/**
	 * Ustawia tytuł
	 * @param string $title
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setTitle($title) {
		return $this->set('title', $title);
	}

	/**
	 * Ustawia keywords
	 * @param string $keywords
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setKeywords($keywords) {
		return $this->set('keywords', $keywords);
	}

	/**
	 * Ustawia opis
	 * @param string $description
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDescription($description) {
		return $this->set('description', $description);
	}

	/**
	 * Ustawia uri
	 * @param string $uri
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setUri($uri) {
		return $this->set('uri', $uri);
	}

	/**
	 * Ustawia HTTPS
	 * @param boolean $https
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setHttps($https = null) {
		//jeśli https null (bez zmiany)
		if ($https === null) {
			return $this->set('https', null);
		}
		//w pozostałych sytuacjach wymuszamy bool
		return $this->set('https', (bool) $https);
	}

	/**
	 * Ustawia typ linku na absolutny
	 * @param boolean $absolute
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setAbsolute($absolute = true) {
		return $this->set('absolute', (bool) $absolute);
	}

	/**
	 * Ustawia typ meta na niezależne
	 * @param boolean $independent
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setIndependent($independent = true) {
		return $this->set('independent', (bool) $independent);
	}

	/**
	 * Ustawia typ linku na nofollow
	 * @param boolean $nofollow
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setNofollow($nofollow = true) {
		return $this->set('nofollow', (bool) $nofollow);
	}

	/**
	 * Ustawia target linku na blank
	 * @param boolean $blank
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setBlank($blank = true) {
		return $this->set('blank', (bool) $blank);
	}

	/**
	 * Ustawia datę włączenia węzła
	 * @param string $dateStart
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDateStart($dateStart) {
		return $this->set('dateStart', $dateStart);
	}

	/**
	 * Ustawia datę wyłączenia węzła
	 * @param string $dateEnd
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function setDateEnd($dateEnd) {
		return $this->set('dateEnd', $dateEnd);
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
		//korzysta z klasy buildera
		return ($this->_build = Builder::build($this->_data));
	}

}
