<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class Navigation extends HelperAbstract {

	/**
	 * Maksymalna głębokość menu
	 * @var int
	 */
	private $_maxDepth = 1000;

	/**
	 * Minimalna głębokość menu
	 * @var int
	 */
	private $_minDepth = 0;

	/**
	 * Separator breadcrumbs
	 * @var string
	 */
	private $_separator = ' &gt; ';

	/**
	 * Separator breadcrumbs
	 * @var string
	 */
	private $_metaSeparator = ' - ';

	/**
	 * Renderuje tylko aktywną gałąź
	 * @var boolean
	 */
	private $_activeBranch = false;

	/**
	 * Renderuje tylko dozwolone w ACL
	 * @var boolean
	 */
	private $_allowedOnly = true;

	/**
	 * Identyfikator węzła startowego
	 * @var root
	 */
	private $_root;

	/**
	 * Przechowuje tytuł aktywnej strony
	 * @var string
	 */
	private $_title;

	/**
	 * Przechowuje breadcrumbs
	 * @var string
	 */
	private $_breadcrumbs;

	/**
	 * Przechowuje breadcrumbs w postaci tabelarycznej
	 * @var array
	 */
	private $_breadcrumbsData;

	/**
	 * Przechowuje czy ostatni breadcrumb to link
	 * @var bool
	 */
	private $_linkLastBreadcrumb = false;

	/**
	 * Przechowuje słowa kluczowe aktywnej strony
	 * @var string
	 */
	private $_keywords;

	/**
	 * Przechowuje opis aktywnej strony
	 * @var string
	 */
	private $_description;

	/**
	 * Obiekt nawigatora
	 * @var \Mmi\Navigation
	 */
	private static $_navigation;

	/**
	 * Obiekt ACL
	 * @var \Mmi\Acl
	 */
	private static $_acl;

	/**
	 * Obiekt Auth
	 * @var \Mmi\Auth
	 */
	private static $_auth;

	/**
	 * Ustawia obiekt nawigatora
	 * @param \Mmi\Navigation $navigation
	 * @return \Mmi\Navigation
	 */
	public static function setNavigation(\Mmi\Navigation $navigation) {
		self::$_navigation = $navigation;
		return $navigation;
	}

	/**
	 * Ustawia obiekt autoryzacji
	 * @param \Mmi\Auth $auth
	 * @return \Mmi\Auth
	 */
	public static function setAuth(\Mmi\Auth $auth) {
		self::$_auth = $auth;
		return $auth;
	}

	/**
	 * Ustawia obiekt ACL
	 * @param \Mmi\Acl $acl
	 * @return \Mmi\Acl
	 */
	public static function setAcl(\Mmi\Acl $acl) {
		self::$_acl = $acl;
		return $acl;
	}

	/**
	 * Metoda główna, zwraca swoją instancję
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function navigation() {
		if (null === $this->_breadcrumbs) {
			return $this->_buildBreadcrumbs();
		}
		//ustawienia domyślne
		$this->_maxDepth = 1000;
		$this->_minDepth = 0;
		$this->_activeBranch = false;
		$this->_allowedOnly = true;
		return $this;
	}

	/**
	 * Renderer menu
	 * @return string
	 */
	public function __toString() {
		return $this->menu();
	}

	/**
	 * Ustawia maksymalną głębokość
	 * @param int $depth maksymalna głębokość
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setMaxDepth($depth = 1000) {
		$this->_maxDepth = $depth;
		return $this;
	}

	/**
	 * Ustawia minimalną głębokość
	 * @param int $depth minimalna głębokość
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setMinDepth($depth = 0) {
		$this->_minDepth = $depth;
		return $this;
	}

	/**
	 * Ustawia separator breadcrumbs
	 * @param string $separator separator
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setSeparator($separator) {
		$this->_separator = $separator;
		$this->_buildBreadcrumbs();
		return $this;
	}

	/**
	 * Ustawia seperator w meta
	 * @param string $separator separator
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setMetaSeparator($separator) {
		$this->_metaSeparator = $separator;
		$this->_buildBreadcrumbs();
		return $this;
	}

	/**
	 * Ustawia rendering wyłącznie głównej gałęzi
	 * @param boolean $active aktywna
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setActiveBranchOnly($active = true) {
		$this->_activeBranch = $active;
		return $this;
	}

	/**
	 * Ustawia rendering wyłącznie dozwolonych elementów
	 * @param boolean $allowed dozwolone
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setAllowedOnly($allowed = true) {
		$this->_allowedOnly = $allowed;
		return $this;
	}

	/**
	 * Ustawia węzeł startowy
	 * @param int $key klucz
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setRoot($key) {
		$this->setMinDepth();
		$this->setMaxDepth();
		$this->_root = $key;
		return $this;
	}

	/**
	 * Ustawia tytuł
	 * @param string $title tytuł
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setTitle($title) {
		$this->_title = $title;
		return $this;
	}

	/**
	 * Pobiera tytuł
	 * @return string
	 */
	public function getTitle() {
		return $this->title();
	}

	/**
	 * Ustawia opis
	 * @param string $description opis
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setDescription($description) {
		$this->_description = $description;
		return $this;
	}

	/**
	 * Pobiera opis
	 * @return string
	 */
	public function getDescription() {
		return $this->description();
	}

	/**
	 * Ustawia słowa kluczowe
	 * @param string $keywords słowa kluczowe
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setKeywords($keywords) {
		$this->_keywords = $keywords;
		return $this;
	}

	/**
	 * Zwraca słowa kluczowe
	 * @return string
	 */
	public function getKeywords() {
		return $this->_keywords;
	}

	/**
	 * Zwraca breadcrumbs w postaci tabeli
	 * @return array
	 */
	public function getBreadcrumbs() {
		return $this->_breadcrumbsData;
	}

	/**
	 * Zwraca bieżącą głębokość w menu
	 * @return int
	 */
	public function getCurrentDepth() {
		$depth = count($this->_breadcrumbsData) - 1;
		return ($depth > 0) ? $depth : 0;
	}

	/**
	 * Zwraca breadcrumbs
	 * @return string
	 */
	public function breadcrumbs() {
		return $this->_breadcrumbs;
	}

	/**
	 * Linkuj ostatni breadcrumb w ścieżce
	 * @param bool $link linkuj
	 */
	public function linkLastBreadcrumb($link = true) {
		$this->_linkLastBreadcrumb = $link;
		return $this;
	}

	/**
	 * Modyfikuje breadcrumbs
	 * @param int $index indeks
	 * @param string $label etykieta
	 * @param string $uri URL
	 * @param string $title tytuł
	 * @param string $description opis
	 * @param string $keywords słowa kluczowe
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function modifyBreadcrumb($index, $label, $uri = null, $title = null, $description = null, $keywords = null) {
		if (!isset($this->_breadcrumbsData[$index])) {
			return $this;
		}
		if (null !== $label) {
			$this->_breadcrumbsData[$index]['label'] = $label;
		}
		if (null !== $uri) {
			$this->_breadcrumbsData[$index]['uri'] = $uri;
		}
		if (null !== $title) {
			$this->_breadcrumbsData[$index]['title'] = $title;
		}
		if (null !== $description) {
			$this->_breadcrumbsData[$index]['description'] = $description;
		}
		if (null !== $keywords) {
			$this->_breadcrumbsData[$index]['keywords'] = $keywords;
		}
		return $this->_buildBreadcrumbs();
	}

	/**
	 * Modyfikuje ostatni breadcrumb
	 * @param string $label etykieta
	 * @param string $uri URL
	 * @param string $title tytuł
	 * @param string $description opis
	 * @param string $keywords słowa kluczowe
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function modifyLastBreadcrumb($label, $uri = null, $title = null, $description = null, $keywords = null) {
		return $this->modifyBreadcrumb(count($this->_breadcrumbsData) - 1, $label, $uri, $title, $description, $keywords);
	}

	/**
	 * Dodaje breadcrumb
	 * @param string $label etykieta
	 * @param string $uri URL
	 * @param string $title tytuł
	 * @param string $description opis
	 * @param string $keywords słowa kluczowe
	 * @param bool $unshift wstaw na początku
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function createBreadcrumb($label, $uri = null, $title = null, $description = null, $keywords = null, $unshift = false) {
		$breadcrumb = array(
			'label' => $label,
			'uri' => $uri,
			'title' => $title,
			'description' => $description,
			'keywords' => $keywords
		);
		if ($unshift) {
			array_unshift($this->breadcrumbsData, $breadcrumb);
		} else {
			$this->_breadcrumbsData[] = $breadcrumb;
		}
		return $this->_buildBreadcrumbs();
	}

	/**
	 * Dodaje breadcrumb na koniec
	 * @param string $label etykieta
	 * @param string $uri URL
	 * @param string $title tytuł
	 * @param string $description opis
	 * @param string $keywords słowa kluczowe
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function appendBreadcrumb($label, $uri = null, $title = null, $description = null, $keywords = null) {
		return $this->createBreadcrumb($label, $uri, $title, $description, $keywords, false);
	}

	/**
	 * Dodaje breadcrumb na początek
	 * @param string $label etykieta
	 * @param string $uri URL
	 * @param string $title tytuł
	 * @param string $description opis
	 * @param string $keywords słowa kluczowe
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function prependBreadcrumb($label, $uri = null, $title = null, $description = null, $keywords = null) {
		return $this->createBreadcrumb($label, $uri, $title, $description, $keywords, true);
	}

	/**
	 * Tworzy okruchy
	 * @param array $breadcrumbs okruchy tablica tablic(label, uri, title, description, keywords)
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function setBreadcrumbs(array $breadcrumbs = array()) {
		$this->_breadcrumbsData = array();
		foreach ($breadcrumbs as $breadcrumb) {
			$bdc = array(
				'label' => isset($breadcrumb[0]) ? $breadcrumb[0] : '',
				'uri' => isset($breadcrumb[1]) ? $breadcrumb[1] : '',
				'title' => isset($breadcrumb[2]) ? $breadcrumb[2] : '',
				'description' => isset($breadcrumb[3]) ? $breadcrumb[3] : '',
				'keywords' => isset($breadcrumb[4]) ? $breadcrumb[4] : ''
			);
			$this->_breadcrumbsData[] = $bdc;
		}
		return $this->_buildBreadcrumbs();
	}

	/**
	 * Usuwa ostatni breadcrumb
	 * @return \Mmi\View\Helper\Navigation
	 */
	public function removeLastBreadcrumb() {
		$index = count($this->_breadcrumbsData) - 1;
		if (!isset($this->_breadcrumbsData[$index])) {
			return $this;
		}
		unset($this->_breadcrumbsData[$index]);
		return $this->_buildBreadcrumbs();
	}

	/**
	 * Zwraca tytuł aktywnej strony
	 * @return string
	 */
	public function title() {
		return $this->_title;
	}

	/**
	 * Zwraca słowa kluczowe aktywnej strony
	 * @return string
	 */
	public function keywords() {
		return str_replace(array('&amp;nbsp;', '&amp;oacute;', '-  -'), array(' ', 'ó', '-'), $this->_keywords);
	}

	/**
	 * Zwraca opis aktywnej strony
	 * @return string
	 */
	public function description() {
		return trim(str_replace(array('&amp;nbsp;', '&amp;oacute;', '-  -'), array(' ', 'ó', '-'), strip_tags($this->_description)), ' -');
	}

	/**
	 * Alias renderera menu
	 * @see \Mmi\View\Helper\Navigation::menu()
	 * @return string
	 */
	public function renderMenu() {
		return $this->menu();
	}

	/**
	 * Renderer menu
	 * @return string
	 */
	public function menu() {
		if (null === self::$_navigation) {
			return '';
		}
		if ($this->_root) {
			$tree = self::$_navigation->seek($this->_root);
		} else {
			$tree = null;
		}
		return $this->_getHtml($tree);
	}

	/**
	 * Buduje breadcrumbs
	 * @return \Mmi\View\Helper\Navigation
	 */
	private function _buildBreadcrumbs() {
		if (null === self::$_navigation) {
			return $this;
		}
		if (null == $this->_breadcrumbsData) {
			$data = self::$_navigation->getBreadcrumbs();
			$this->_breadcrumbsData = $data;
		} else {
			$data = $this->_breadcrumbsData;
		}
		if (!is_array($data)) {
			return $this;
		}
		$title = array();
		$breadcrumbs = array();
		$keywords = array();
		$descriptions = array();
		$count = count($data);
		$i = 0;
		foreach ($data as $breadcrumb) {
			$i++;
			if (($i == $count && !$this->_linkLastBreadcrumb) || $breadcrumb['uri'] == '#') {
				$breadcrumbs[] = '<span>' . strip_tags($breadcrumb['label']) . '</span>';
			} else {
				$breadcrumbs[] = '<a href="' . $breadcrumb['uri'] . '">' . strip_tags($breadcrumb['label']) . '</a>';
			}
			$title[] = (isset($breadcrumb['title']) && $breadcrumb['title']) ? strip_tags($breadcrumb['title']) : strip_tags($breadcrumb['label']);
			if (isset($breadcrumb['keywords'])) {
				$keywords[] = htmlspecialchars($breadcrumb['keywords']);
			}
			if (isset($breadcrumb['description'])) {
				$descriptions[] = htmlspecialchars($breadcrumb['description']);
			}
		}
		$this->_title = trim(implode($this->_metaSeparator, array_reverse($title)));
		$this->_breadcrumbs = trim(implode($this->_separator, $breadcrumbs));
		$this->_description = trim(implode($this->_metaSeparator, array_reverse($descriptions)));
		$this->_keywords = trim(implode(' ', array_reverse($keywords)));
		return $this;
	}

	/**
	 * Renderuje drzewo
	 * @param array $tree drzewo
	 * @param int $depth głębokość
	 * @return string
	 */
	private function _getHtml($tree, $depth = 0) {
		if (empty($tree) || !isset($tree['children'])) {
			return '';
		}
		$aclCheck = (self::$_auth instanceof \Mmi\Auth && self::$_acl instanceof \Mmi\Acl);
		$menu = $tree['children'];
		//przygotowanie menu do wyświetlenia: usunięcie niedozwolonych i nieaktywnych elementów
		foreach ($menu as $key => $leaf) {
			if (!$leaf['module']) {
				$leaf['module'] = 'default';
			}
			if ($this->_allowedOnly && $leaf['type'] != 'link' && $aclCheck) {
				$allowed = self::$_acl->isAllowed(self::$_auth->getRoles(), strtolower($leaf['module'] . ':' . $leaf['controller'] . ':' . $leaf['action']));
			} else {
				$allowed = true;
			}
			if ($leaf['disabled'] || !$leaf['visible'] || !$allowed) {
				unset($menu[$key]);
			}
		}
		$html = '';
		$index = 0;
		$count = count($menu);
		$childHtml = '';

		foreach ($menu as $leaf) {
			$subHtml = '';
			if ($this->_activeBranch && isset($leaf['active'])) {
				$recurse = $leaf['active'];
			} else {
				$recurse = true;
			}
			if (isset($leaf['children']) && $depth < $this->_maxDepth && $recurse) {
				$subHtml = $this->_getHtml($leaf, $depth + 1);
				$childHtml .= $subHtml;
			}
			$class = (isset($leaf['active']) && $leaf['active']) ? 'active current ' : '';
			$class .= ($index == 0) ? 'first ' : '';
			$class .= ($index == ($count - 1)) ? 'last ' : '';
			if ($class) {
				$class = ' class="' . rtrim($class) . '"';
			}
			$extras = '';
			if (isset($leaf['nofollow']) && $leaf['nofollow'] == 1) {
				$extras .= ' rel="nofollow"';
			}
			if (isset($leaf['blank']) && $leaf['blank'] == 1) {
				$extras .= ' target="_blank"';
			}
			$html .= '<li id="item-' . $leaf['id'] . '" ' . $class . '><span class="item-begin"></span><a href="' . htmlspecialchars($leaf['uri']) . '"' . $extras . '>' . $leaf['label'] . '</a>' . $subHtml . '<span class="item-end"></span></li>';
			$index++;
		}
		if ($this->_minDepth > $depth) {
			return $childHtml;
		} elseif ($html) {
			return '<ul class="menu depth-' . $depth . '" id="menu-' . $tree['id'] . '">' . $html . '</ul>' . PHP_EOL;
		} else {
			return '';
		}
	}

}
