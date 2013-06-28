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
 * Mmi/View/Helper/HeadMeta.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper meta w nagłówku strony
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_HeadMeta extends Mmi_View_Helper_AbstractHead {

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
	 * @return Mmi_View_Helper_HeadScript
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
			$html .= '<meta ';
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
