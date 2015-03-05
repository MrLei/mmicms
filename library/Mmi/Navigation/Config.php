<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Navigation;

class Config {

	/**
	 * Dane nawigacji
	 * @var array
	 */
	protected $_data = array();

	/**
	 * Indeks elementów
	 * @var int
	 */
	protected static $_index = 1000000;

	/**
	 * Zbudowany obiekt
	 * @var array
	 */
	public $build = array();

	/**
	 * Dodaje element nawigatora
	 * @param int $id klucz
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function addElement(\Mmi\Navigation\Config\Element $element) {
		$this->_data[$element->getId()] = $element;
		return $this;
	}

	/**
	 * Tworzy nowy element nawigacyjny
	 * @param int $id opcjonalny parametr klucza (zostanie zastąpiony domyślnym gdy nieobecny)
	 * @return \Mmi\Navigation\Config\Element
	 */
	public static function newElement($id = null) {
		return new \Mmi\Navigation\Config\Element($id);
	}

	/**
	 * Zwraca i inkrementuje indeks elementów
	 * @return int
	 */
	public static function getAutoIndex() {
		return self::$_index++;
	}

	/**
	 * Znajduje element po identyfikatorze
	 * @param int $id identyfikator
	 * @return \Mmi\Navigation\Config\Element
	 */
	public function findById($id, $withParents = false) {
		$parents = array();
		foreach ($this->build() as $element) {
			if (null !== ($found = $this->_findInChildren($element, $id, $withParents, $parents))) {
				if ($withParents) {
					$found['parents'] = array_reverse($parents);
				}
				return $found;
			}
		}
	}

	/**
	 * Rekurencyjnie przeszukuje elementy potomne
	 * @param $element
	 * @param int $id identyfikator
	 * @return array
	 */
	protected function _findInChildren(array $element, $id, $withParents, array &$parents) {
		if ($element['id'] == $id) {
			return $element;
		}
		foreach ($element['children'] as $child) {
			if ($child['id'] == $id) {
				if ($withParents) {
					$parents[] = $element;
				}
				return $child;
			}
			if (null !== ($found = $this->_findInChildren($child, $id, $withParents, $parents))) {
				if ($withParents) {
					$parents[] = $element;
				}
				return $found;
			}
		}
	}

	/**
	 * Buduje wszystkie obiekty
	 * @return array
	 */
	public function build() {
		if (!empty($this->build)) {
			return $this->build;
		}
		$this->build = array(array(
				'active' => true,
				'name' => '',
				'label' => '',
				'id' => 0,
				'level' => 0,
				'uri' => '',
				'children' => array()
		));
		foreach ($this->_data as $element) {
			$this->build[0]['children'][$element->getId()] = $element->build();
		}
		//usuwanie konfiguracji po zbudowaniu
		$this->_data = array();
		return $this->build;
	}

}
