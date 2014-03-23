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
 * Mmi/Nested.php
 * @category   Mmi
 * @package    Mmi_Nested
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa struktur zagnieżdżonych
 * @category   Mmi
 * @package    Mmi_Nested
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Nested {

	/**
	 * Tabela ze strukturą
	 * @var array
	 */
	public $structure;

	/**
	 * Konstruktor ustawia dane do ułożenia w strukturę
	 * @param array $data dane
	 * @param bool $nested zagnieżdżenie w tablicy
	 * @return Mmi_Nested
	 */
	public function __construct(array $data, $nested = false) {
		if ($nested) {
			$this->_buildStructureFromNested($data);
			return $this;
		}
		$this->_buildStructure($data);
		return $this;
	}

	/**
	 * Pobierz tabele ze strukturą
	 * @return array
	 */
	public function getStructure() {
		return $this->structure;
	}

	/**
	 * Wyszukuje element, wraz jego dziećmi, oraz rodzicami
	 * @param string $value wyszukiwana wartość
	 * @param string $field nazwa pola
	 * @return array
	 */
	public function seek($value, $field = 'id') {
		$result = $this->_seek($this->structure, $field, $value);
		if (!isset($result['id'])) {
			return array();
		}
		if (isset($result['parents'])) {
			$result['parents'] = array_reverse($result['parents']);
		} else {
			$result['parents'] = array();
		}
		if (!isset($result['children'])) {
			$result['children'] = array();
		}
		return $result;
	}

	/**
	 * Buduje strukture kategorii z zagnieżdżonej tablicy
	 * @param array $array dane
	 */
	protected function _buildStructureFromNested(array $array) {
		$this->structure = array(array(
				'name' => '',
				'label' => '',
				'id' => 0,
				'level' => 0,
				'uri' => '',
				'children' => $array
		));
		return $this;
	}

	/**
	 * Rekurencyjnie wyszukuje elementy
	 * @param array $branch gałąź
	 * @param string $field nazwa pola
	 * @param string $value wyszukiwana wartość
	 * @return array
	 */
	public function _seek($branch, $field, $value) {
		$result = null;
		foreach ($branch as $leaf) {
			if (isset($leaf[$field]) && $leaf[$field] == $value) {
				return $leaf;
			}
			if (isset($leaf['children'])) {
				$result = $this->_seek($leaf['children'], $field, $value);
				if ($result !== null) {
					$result['parents'][$leaf['id']] = isset($branch[$leaf['id']]) ? $branch[$leaf['id']] : $branch[0];
				}
			}
			if (null !== $result) {
				return $result;
			}
		}
	}

	/**
	 * Spłaszcza drzewo kategorii do tablicy
	 * @param array $branch drzewo do spłaszczenia
	 * @return array spłaszczona tablica
	 */
	public function flat($branch) {
		$result = array();
		$this->_getFlat($branch, $result);
		return $result;
	}

	/**
	 * Rekurencyjnie spłaszcza drzewo kategorii
	 * do przekazanej tablicy
	 * @param array $branch drzewo
	 * @param array $result tablica wynikowa
	 */
	public function _getFlat($branch, &$result) {
		foreach ($branch as $leaf) {
			if (isset($leaf['id'])) {
				$trimmed = $leaf;
				unset($trimmed['children']);
				unset($trimmed['parent_id']);
				$result[$leaf['id']] = $trimmed;
			}
			if (!empty($leaf['children'])) {
				$this->_getFlat($leaf['children'], $result);
			}
		}
	}

	/**
	 * Buduje strukturę kategorii w której
	 * będą zagnieżdżane dzieci danej gąłęzi
	 * @param array $flat płaskie dane (zawiera id rodzica)
	 */
	protected function _buildStructure($flat) {
		$this->structure = array(0 => array(
				'name' => null,
				'label' => null,
				'id' => 0,
				'level' => 0,
				'uri' => ''
		));
		$this->_buildChildren($this->structure, $flat);
	}

	/**
	 * Buduje dzieci danej gałęzi (rekursywna)
	 * Finalnie buduje strukturę drzewiastą
	 * @param array $branch gałąź
	 * @param array $flat płaskie dane (zawiera id rodzica)
	 * @param int $level poziom
	 */
	protected function _buildChildren(&$branch, $flat, $level = 0) {
		foreach ($branch as $key => $leaf) {
			$branch[$key]['level'] = $level;
			foreach ($flat as $flatKey => $item) {
				if ($item['parent_id'] != $leaf['id']) {
					continue;
				}
				unset($flat[$flatKey]);
				$branch[$key]['children'][$item['id']] = $item;
			}
			if (isset($branch[$key]['children']) && is_array($branch[$key]['children'])) {
				$this->_buildChildren($branch[$key]['children'], $flat, $level + 1);
			}
		}
	}

}
