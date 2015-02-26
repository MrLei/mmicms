<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Navigation.php
 * @category   Mmi
 * @package    \Mmi\Navigation
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa nawigacji, do renderingu używa \Mmi\View\Helper\Navigation
 * @see        \Mmi\View\Helper\Navigation
 * @category   Mmi
 * @package    \Mmi\Navigation
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Navigation {

	/**
	 * Klasa kongiguracji
	 * @var \Mmi\Navigation\Config
	 */
	private $_config;

	/**
	 * Breadcrumbs
	 * @var array
	 */
	private $_breadcrumbs = array();

	/**
	 * Konstruktor, buduje drzewo na podstawie struktury zagnieżdżonej
	 * @param \Mmi\Navigation\Config $config konfiguracja nawigatora
	 */
	public function __construct(\Mmi\Navigation\Config $config) {
		$this->_config = $config;
		$config->build();
	}

	/**
	 * Określa elementy aktywne, buduje breadcrumbs
	 * @param \Mmi\Controller\Request $request
	 * @return \Mmi\Translate
	 */
	public function setup(\Mmi\Controller\Request $request) {
		$activatedTree = $this->_setupActive($this->_config->built, $request->getParams());
		if (isset($activatedTree['tree'][0]['children'])) {
			$this->_setupBreadcrumbs($activatedTree['tree'][0]['children']);
		}
		return $this;
	}

	/**
	 * Wyszukuje element, wraz jego dziećmi, oraz rodzicami
	 * @param string $id wyszukiwane id
	 * @return array
	 */
	public function seek($id) {
		return $this->_config->findById($id);
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
		foreach ($tree as $key => $item) {
			$active = true;
			if (!isset($item['request'])) {
				$active = false;
			} else {
				foreach ($item['request'] as $name => $param) {
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
			if ($tree[$key]['active'] && array_key_exists('visible', $tree[$key])) {
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
