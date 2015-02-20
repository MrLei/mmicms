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
 * Mmi/View/Helper/HeadMeta.php
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Helper meta w nagłówku strony
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
namespace Mmi\View\Helper;
class HeadMeta extends HeadAbstract {

	/**
	 * Dane
	 * @var array
	 */
	private $_data = array();

	/**
	 * Metoda główna, dodaje skrypt do stosu
	 * @param array $params parametry skryptu
	 * @param boolean $prepend dodaj na początek stosu
	 * @param string $conditional warunek np. ie6
	 * @return \Mmi\View\Helper\HeadMeta
	 */
	public function headMeta(array $params = array(), $prepend = false, $conditional = '') {
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
	 * Renderer skryptów
	 * @return string
	 */
	public function __toString() {
		$html = '';
		foreach ($this->_data as $meta) {
			$conditional = $meta['conditional'];
			unset($meta['conditional']);
			if ($conditional) {
				$html .= '<!--[if ' . $conditional . ']>';
			}
			$html .= '	<meta ';
			foreach ($meta as $key => $value) {
				$html .= $key. '="' . $value . '" ';
			}
			$html .= '/>';
			if ($conditional) {
				$html .= '<![endif]-->';
			}
			$html .= PHP_EOL;
		}
		return $html;
	}

}
