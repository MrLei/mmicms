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
 * Mmi/Navigation.php
 * @category   Mmi
 * @package    Mmi_Navigation
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa nawigacji, do renderingu używa Mmi_View_Helper_Navigation
 * @see        Mmi_View_Helper_Navigation
 * @category   Mmi
 * @package    Mmi_Navigation
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Navigation {

	/**
	 * Klasa struktur zagnieżdżonych
	 * @var Mmi_Nested
	 */
	private $_nested;

	/**
	 * Breadcrumbs
	 * @var array
	 */
	private $_breadcrumbs = array();

	/**
	 * Konstruktor, buduje drzewo na podstawie struktury zagnieżdżonej
	 * @param Mmi_Nested $nested struktura zagnieżdżona
	 */
	public function __construct(Mmi_Nested $nested) {
		$this->_nested = $nested;
	}

	/**
	 * Określa elementy aktywne, buduje breadcrumbs
	 * @param Mmi_Controller_Request $request
	 * @return Mmi_Translate
	 */
	public function setup(Mmi_Controller_Request $request) {
		$activatedTree = $this->_setupActive($this->_nested->structure, $request->getParams());
		if (isset($activatedTree['tree'][0]['children'])) {
			$this->_setupBreadcrumbs($activatedTree['tree'][0]['children']);
		}
		return $this;
	}

	/**
	 * Pobiera zagnieżdżone drzewo
	 * @return array
	 */
	public function getTree() {
		return $this->_nested->seek(0);
	}
	
	/**
	 * Wyszukuje element, wraz jego dziećmi, oraz rodzicami
	 * @param string $id wyszukiwane id
	 * @return array
	 */
	public function seek($id) {
		return $this->_nested->seek($id);
	}
	/**
	 * Pobiera breadcrumbs
	 * @return array
	 */
	public function getBreadcrumbs() {
		return $this->_breadcrumbs;
	}

	/**
	 * Wykorzystywane przez setup do ustawiania elementów aktywnych
	 * @param array $tree poddrzewo
	 * @param array $params parametry decydujące o aktywności
	 * @return array
	 */
	private function _setupActive(&$tree, $params) {
		$branchActive = false;
		foreach($tree as $key => $item) {
			$active = true;
			if (!isset($item['request'])) {
				$active = false;
			} else {
				foreach($item['request'] as $name => $param) {
					if (!isset($params[$name]) || $params[$name] != $param) {
						$active = false;
						break;
					}
				}
			}
			$tree[$key]['active'] = $active;
			if ($active) {
				$branchActive = true;
			}
			if (isset($item['children'])) {
				$branch = $this->_setupActive($item['children'], $params);
				$tree[$key]['children'] = $branch['tree'];
				if ($branch['active']) {
					$tree[$key]['active'] = true;
				}
			}
			if ($tree[$key]['active'] == 1 && array_key_exists('visible', $tree[$key])) {
				unset($item['children']);
				$branchActive = true;
			}
		}
		return array('tree' => $tree, 'active' => $branchActive);
	}
	
	/**
	 * Buduje breadcrumbs z aktywowanego drzewa
	 * @param array $tree drzewo
	 */
	private function _setupBreadcrumbs($tree) {
		foreach ($tree as $item) {
			if ($item['active'] == 1) {
				if ($item['module'] != '' || $item['visible'] == 1) {
					$this->_breadcrumbs[] = $item;
				}
				if (isset($item['children'])) {
					$this->_setupBreadcrumbs($item['children']);
				}
				break;
			}
		}
		if (count($this->_breadcrumbs) == 0) {
			return;
		}
		$currentItem = $this->_breadcrumbs[count($this->_breadcrumbs) - 1];
		if (isset($currentItem['independent']) && $currentItem['independent']) {
			$this->_breadcrumbs = array($this->_breadcrumbs[count($this->_breadcrumbs) - 1]);
		}
	}

}
