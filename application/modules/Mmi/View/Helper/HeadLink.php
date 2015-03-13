<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class HeadLink extends HeadAbstract {

	/**
	 * Dane
	 * @var array
	 */
	private $_data = array();

	/**
	 * Metoda główna, dodająca link do stosu
	 * @param array $params parametry linku (jak rel, type, href)
	 * @param boolean $prepend dodaj na początek stosu
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function headLink(array $params = array(), $prepend = false, $conditional = '') {
		if (!empty($params)) {
			$params['conditional'] = $conditional;
			if (array_search($params, $this->_data) !== false) {
				return '';
			}
			if ($prepend) {
				array_unshift($this->_data, $params);
			} else {
				array_push($this->_data, $params);
			}
			return '';
		}
		return $this;
	}

	/**
	 * Renderer linków
	 * @return string
	 */
	public function __toString() {
		$html = '';
		foreach ($this->_data as $link) {
			$conditional = $link['conditional'];
			unset($link['conditional']);
			if ($conditional) {
				$html .= '<!--[if ' . $conditional . ']>';
			}
			$html .= '	<link ';
			$crc = isset($link['crc']) ? $link['crc'] : null;
			unset($link['crc']);
			foreach ($link as $key => $value) {
				if ($key == 'href' && $crc !== null) {
					if (strpos($value, '?')) {
						$value .= '&crc=' . $crc;
					} else {
						$value .= '?crc=' . $crc;
					}
				}
				$html .= $key . '="' . $value . '" ';
			}
			$html .= '/>';
			if ($conditional) {
				$html .= '<![endif]-->';
			}
			$html .= PHP_EOL;
		}
		return $html;
	}

	/**
	 * Dodaje styl CSS na koniec stosu
	 * @param string $href adres
	 * @param string $media media
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function appendStylesheet($href, $media = null, $conditional = '') {
		return $this->setStylesheet($href, $media, false, $conditional);
	}

	/**
	 * Dodaje styl CSS na początek stosu
	 * @param string $href adres
	 * @param string $media media
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function prependStylesheet($href, $media = null) {
		return $this->setStylesheet($href, $media, true);
	}

	/**
	 * Dodaje styl CSS do stosu
	 * @param string $href adres
	 * @param string $media media
	 * @param boolean $prepend dodaj na początku stosu
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function setStylesheet($href, $media = null, $prepend = false, $conditional = '') {
		$params = array('rel' => 'stylesheet', 'type' => 'text/css', 'href' => $href, 'crc' => $this->_getCrc($href));
		if ($media) {
			$params['media'] = $media;
		}
		return $this->headLink($params, $prepend, $conditional);
	}

	/**
	 * Dodaje alternate na koniec stosu
	 * @param string $href adres
	 * @param string $type typ
	 * @param string $title tytuł
	 * @param string $media media
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function appendAlternate($href, $type, $title, $media = null, $conditional = '') {
		return $this->setAlternate($href, $type, $title, $media = null, true, $conditional);
	}

	/**
	 * Dodaje alternate na początek stosu
	 * @param string $href adres
	 * @param string $type typ
	 * @param string $title tytuł
	 * @param string $media media
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function prependAlternate($href, $type, $title, $media = null, $conditional = '') {
		return $this->setAlternate($href, $type, $title, $media = null, false, $conditional);
	}

	/**
	 * Dodaje alternate do stosu
	 * @param string $href adres
	 * @param string $type typ
	 * @param string $title tytuł
	 * @param string $media media
	 * @param boolean $prepend dodaj na początku stosu
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadLink
	 */
	public function setAlternate($href, $type, $title, $media = null, $prepend = false, $conditional = '') {
		$params = array('rel' => 'alternate', 'type' => $type, 'title' => $title, 'href' => $href, $crc = $this->_getCrc($href));
		if ($media) {
			$params['media'] = $media;
		}
		return $this->headLink($params, $prepend, $conditional);
	}

}
