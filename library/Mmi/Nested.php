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
	 */
	public function __construct(array $data, $nested = false) {
		if ($nested) {
			$this->structure = array();
			$data = array(array('children' => $data));
			$this->_buildStructureFromNested($data, $this->structure, 0, 0, 0);
			return $this;
		}
		$this->_buildStructure($data);
		return $this;
	}

	public function getStructure() {
		return $this->structure;
	}

	/**
	 * Wyszukuje element, wraz jego dziećmi, oraz rodzicami
	 * @param string $value wyszukiwana wartość
	 * @param string $field nazwa pola
	 * @param bool $parents dołącza rodziców
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

	protected function _buildStructureFromNested(array &$array, array &$target, $id = 0, $parent_id = 0, $level = 1) {
		foreach ($array as $k => $v) {
			$id++;
			$array[$k]['id'] = $id;
			$array[$k]['parent_id'] = $parent_id;
			$parent_id = $id;
			$array[$k]['request'] = array();
			$array[$k]['level'] = $level;
			$array[$k]['lang'] = isset($v['lang']) ? $v['lang'] : '';
			$array[$k]['module'] = isset($v['module']) ? $v['module'] : '';
			$array[$k]['controller'] = isset($v['controller']) ? $v['controller'] : '';
			$array[$k]['action'] = isset($v['action']) ? $v['action'] : '';
			$array[$k]['visible'] = isset($v['visible']) ? $v['visible'] : 1;
			$array[$k]['active'] = isset($v['active']) ? $v['active'] : 1;
			$array[$k]['request']['lang'] = $array[$k]['lang'];
			$array[$k]['request']['module'] = $array[$k]['module'];
			$array[$k]['request']['controller'] = $array[$k]['controller'];
			$array[$k]['request']['action'] = $array[$k]['action'];
			$array[$k]['params'] = isset($v['params']) ? $v['params'] : '';
			if (is_array($array[$k]['params'])) {
				foreach ($array[$k]['params'] as $paramName => $paramValue) {
					$array[$k]['request'][$paramName] = $paramValue;
				}
			}
			if (!isset($array[$k]['title'])) {
				$array[$k]['title'] = '';
			}
			if (!isset($array[$k]['keywords'])) {
				$array[$k]['keywords'] = '';
			}
			if (!isset($array[$k]['description'])) {
				$array[$k]['description'] = '';
			}
			if (!isset($array[$k]['uri']) && (!isset($array[$k]['type']) || $array[$k]['type'] != 'folder')) {
				$array[$k]['uri'] = Mmi_Controller_Router::getInstance()->encodeUrl($array[$k]['request']);
			} else {
				$array[$k]['uri'] = isset($v['uri']) ? $v['uri'] : '';
			}
			if (!isset($array[$k]['type'])) {
				$array[$k]['type'] = 'cms';
			}
			$localId = $id;
			$target[$localId] = $array[$k];
			if (isset($array[$k]['children'])) {
				$target[$localId]['children'] = array();
				$this->_buildStructureFromNested($array[$k]['children'], $target[$localId]['children'], $id, $parent_id, $level + 1);
			}
		}
	}

	/**
	 * Rekurencyjnie wyszukuje elementy
	 * @param array $branch gałąź
	 * @param string $field nazwa pola
	 * @param string $value wyszukiwana wartość
	 * @param bool $parents dołącza rodziców
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

	public function flat($branch) {
		$result = array();
		$this->_getFlat($branch, $result);
		return $result;
	}

	public function _getFlat($branch, &$result) {
		foreach($branch as $leaf) {
			if (isset($leaf['id']))	{
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
	 * Buduje strukturę kategorii
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