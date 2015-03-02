<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

class Paginator {

	/**
	 * Opcje paginatora
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Konstruktor, przyjmuje opcje, ustawia wartości domyślne
	 * @param array $options opcje
	 */
	public function __construct(array $options = array()) {
		$this->_options = $options;
		if (!isset($this->_options['rowsPerPage'])) {
			$this->_options['rowsPerPage'] = 10;
		}
		if (!isset($this->_options['showPages'])) {
			$this->_options['showPages'] = 10;
		}
		if (!isset($this->_options['previousLabel'])) {
			$this->_options['previousLabel'] = '&#171;';
		}
		if (!isset($this->_options['pageVariable'])) {
			$this->_options['pageVariable'] = 'p';
		}
		if (!isset($this->_options['nextLabel'])) {
			$this->_options['nextLabel'] = '&#187;';
		}
		if (!isset($this->_options['hashHref'])) {
			$this->_options['hashHref'] = '';
		}
	}

	/**
	 * Zwraca limit dla bazy danych
	 * @return int
	 */
	public function getLimit() {
		return $this->_options['rowsPerPage'];
	}

	/**
	 * Pobiera numer aktualnej strony
	 * @return int
	 */
	public function getPage() {
		if (isset($this->_options['page'])) {
			return $this->_options['page'];
		}
		$page = \Mmi\Controller\Front::getInstance()->getView()->request->__get($this->_options['pageVariable']);
		$page = ($page > 0) ? $page : 1;
		$this->_options['page'] = $page;
		return $page;
	}

	/**
	 * Zwraca offset (wiersz startowy) dla bazy danych
	 * @return int
	 */
	public function getOffset() {
		return $this->_options['rowsPerPage'] * ($this->getPage() - 1);
	}

	/**
	 * Ustawia ilość danych do stronnicowania
	 * @param int $count
	 * @return \Mmi\Paginator
	 */
	public function setRowsCount($count) {
		$this->_options['rowsCount'] = intval($count);
		return $this;
	}

	/**
	 * Ustawia ilość wierszy na stronę
	 * @param int $count
	 * @return \Mmi\Paginator
	 */
	public function setRowsPerPage($count) {
		$this->_options['rowsPerPage'] = intval($count);
		return $this;
	}

	/**
	 * Ustawia nazwę zmiennej sterującej paginatorem
	 * @param string $name
	 * @return \Mmi\Paginator
	 */
	public function setPageVariable($name) {
		$this->_options['pageVariable'] = $name;
		return $this;
	}

	/**
	 * Ustawia ilość pokazywanych zakładek skoku (stron)
	 * @param int $pages
	 * @return \Mmi\Paginator
	 */
	public function setShowPages($pages) {
		$this->_options['showPages'] = intval($pages);
		return $this;
	}

	/**
	 * Ustawia tekst pod linkiem poprzedniej strony
	 * @param string $label
	 * @return \Mmi\Paginator
	 */
	public function setPreviousLabel($label) {
		$this->_options['previousLabel'] = $label;
		return $this;
	}

	/**
	 * Ustawia tekst pod linkiem następnej strony
	 * @param string $label
	 * @return \Mmi\Paginator
	 */
	public function setNextLabel($label) {
		$this->_options['nextLabel'] = $label;
		return $this;
	}

	/**
	 * Ustawia dla każdego linku label
	 * @param string $label
	 * @return \Mmi\Paginator
	 */
	public function setHashHref($label) {
		$this->_options['hashHref'] = '#' . $label;
		return $this;
	}

	/**
	 * Zwraca aktualną ilość wierszy w paginatorze
	 * @return int
	 */
	public function getRowsCount() {
		return isset($this->_options['rowsCount']) ? $this->_options['rowsCount'] : 0;
	}

	/**
	 * Zwraca ilość wierszy na stronę
	 * @return int
	 */
	public function getRowsPerPage() {
		return isset($this->_options['rowsPerPage']) ? $this->_options['rowsPerPage'] : 1;
	}

	/**
	 * Zwraca aktualną ilość stron w paginatorze
	 * @return int
	 */
	public function getPagesCount() {
		if ($this->getRowsPerPage() == 0) {
			return 0;
		}
		return ceil($this->getRowsCount() / $this->getRowsPerPage());
	}

	/**
	 * Magiczny rendering paginatora
	 * @return string
	 */
	public function __toString() {
		if (!isset($this->_options['rowsCount'])) {
			return '';
		}
		if (!isset($this->_options['rowsPerPage'])) {
			return '';
		}
		$pagesCount = 0;
		if ($this->_options['rowsPerPage'] != 0) {
			$pagesCount = ceil($this->_options['rowsCount'] / $this->_options['rowsPerPage']);
		}
		if ($pagesCount < 2) {
			return '';
		}
		$view = \Mmi\Controller\Front::getInstance()->getView();
		$showPages = (($this->_options['showPages'] > 2) ? $this->_options['showPages'] : 2) - 2;
		$halfPages = floor($showPages / 2);
		if (!isset($this->_options['page'])) {
			$this->getOffset();
		}
		$pageVariable = $this->_options['pageVariable'];
		$page = $this->_options['page'];
		$previousLabel = $this->_options['previousLabel'];
		$nextLabel = $this->_options['nextLabel'];

		$html = '<div class="paginator">';
		if ($page > 1) {
			$firstPage = (($page - 1) > 1) ? ($page - 1) : null;
			$previousUrl = $view->url(array($pageVariable => $firstPage)) . $this->_options['hashHref'];
			$view->headLink(array('rel' => 'prev', 'href' => $previousUrl));
			$html .= '<span class="previous"><a href="' . $previousUrl . ' ">' . $previousLabel . '</a></span>';
		} else {
			$html .= '<span class="previous">' . $previousLabel . '</span>';
		}

		if (1 == $page) {
			$html .= '<span class="current page">1</span>';
		} else {
			$html .= '<span class="page"><a href="' . $view->url(array($pageVariable => null)) . $this->_options['hashHref'] . '">1</a></span>';
		}

		$rangeBegin = (($page - $halfPages) > 2) ? ($page - $halfPages) : 2;
		$rangeBeginExcess = $halfPages - ($page - 2);
		$rangeBeginExcess = ($rangeBeginExcess > 0) ? $rangeBeginExcess : 0;

		$rangeEnd = (($page + $halfPages) < $pagesCount) ? ($page + $halfPages) : $pagesCount - 1;
		$rangeEndExcess = $halfPages - ($pagesCount - $page - 1);
		$rangeEndExcess = ($rangeEndExcess > 0) ? $rangeEndExcess : 0;

		$rangeEnd = (($rangeEnd + $rangeBeginExcess) < $pagesCount) ? ($rangeEnd + $rangeBeginExcess) : $pagesCount - 1;
		$rangeBegin = (($rangeBegin - $rangeEndExcess) > 2) ? ($rangeBegin - $rangeEndExcess) : 2;

		if ($rangeBegin > 2) {
			$html .= '<span class="dots page"><a href="' . $view->url(array($pageVariable => floor((1 + $rangeBegin) / 2))) . $this->_options['hashHref'] . '">...</a></span>';
		}

		for ($i = $rangeBegin; $i <= $rangeEnd; $i++) {
			if ($i == $page) {
				$html .= '<span class="current page">' . $i . '</span>';
			} else {
				$html .= '<span class="page"><a href="' . $view->url(array($pageVariable => $i)) . $this->_options['hashHref'] . '">' . $i . '</a></span>';
			}
		}

		if ($rangeEnd < $pagesCount - 1) {
			$html .= '<span class="dots page"><a href="' . $view->url(array($pageVariable => ceil(($rangeEnd + $pagesCount) / 2))) . $this->_options['hashHref'] . '">...</a></span>';
		}

		if ($pagesCount == $page) {
			$html .= '<span class="last current page">' . $pagesCount . '</span>';
		} else {
			$html .= '<span class="last page"><a href="' . $view->url(array($pageVariable => $pagesCount)) . $this->_options['hashHref'] . '">' . $pagesCount . '</a></span>';
		}

		if ($page < $pagesCount) {
			$nextUrl = $view->url(array($pageVariable => $page + 1)) . $this->_options['hashHref'];
			$view->headLink(array('rel' => 'next', 'href' => $nextUrl));
			$html .= '<span class="next"><a href="' . $nextUrl . '">' . $nextLabel . '</a></span>';
		} else {
			$html .= '<span class="next">' . $nextLabel . '</span>';
		}
		$html .= '</div>';
		return $html;
	}

}
