<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Navigation/Config.php
 * @category   Mmi
 * @package    Mmi_Navigation
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja nawigatora
 * @category   Mmi
 * @package    Mmi_Navigation
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Navigation_Config {

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
	 * Czy zbudowany
	 * @var array
	 */
	public $built = array();

	/**
	 * Dodaje element nawigatora
	 * @param int $id klucz
	 * @return Mmi_Navigation_Config_Element
	 */
	public function addElement(Mmi_Navigation_Config_Element $element) {
		$this->_data[$element->getId()] = $element;
		return $this;
	}

	/**
	 * Tworzy nowy element nawigacyjny
	 * @param int $id opcjonalny parametr klucza (zostanie zastąpiony domyślnym gdy nieobecny)
	 * @return Mmi_Navigation_Config_Element
	 */
	public static function newElement($id = null) {
		return new Mmi_Navigation_Config_Element($id);
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
	 * @return Mmi_Navigation_Config_Element
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
		if (!empty($this->built)) {
			return $this->built;
		}
		$this->built = array(array(
				'active' => true,
				'name' => '',
				'label' => '',
				'id' => 0,
				'level' => 0,
				'uri' => '',
				'children' => array()
		));
		foreach ($this->_data as $element) {
			$this->built[0]['children'][$element->getId()] = $element->build();
		}
		return $this->built;
	}

}
