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
 * Mmi/View/Helper/HeadScript.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper skryptów w nagłówku strony
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_HeadScript extends Mmi_View_Helper_AbstractHead {

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
	public function headScript(array $params = array(), $prepend = false, $conditional = '') {
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
		foreach ($this->_data as $script) {
			if (isset($script['script'])) {
				$scriptContent = $script['script'];
				unset($script['script']);
			}
			$conditional = $script['conditional'];
			unset($script['conditional']);
			if ($conditional) {
				$html .= '<!--[if ' . $conditional . ']>';
			}
			$html .= '	<script ';
			$crc = $script['crc'];
			unset($script['crc']);
			foreach ($script as $key => $value) {
				if ($key == 'src') {
					if (strpos($value, '?')) {
						$value .= '&crc=' . $crc;
					} else {
						$value .= '?crc=' . $crc;
					}
				}
				$html .= htmlspecialchars($key). '="' . htmlspecialchars($value) . '" ';
			}
			$html .= '>';
			if (isset($scriptContent)) {
				$html .= PHP_EOL . '		// <![CDATA[' . PHP_EOL . $scriptContent . PHP_EOL . '		// ]]>';
				unset($scriptContent);
			}
			$html .= '</script>';
			if ($conditional) {
				$html .= '<![endif]-->';
			}
			$html .= PHP_EOL;
		}
		return $html;
	}

	/**
	 * Dodaje na koniec stosu skrypt z pliku
	 * @param string $src źródło
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function appendFile($src, $type = 'text/javascript', array $params = array(), $conditional = '') {
		return $this->setFile($src, $type, $params, false, $conditional);
	}

	/**
	 * Dodaje na początek stosu skrypt z pliku
	 * @param string $src źródło
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function prependFile($src, $type = 'text/javascript', array $params = array(), $conditional = '') {
		return $this->setFile($src, $type, $params, true, $conditional);
	}

	/**
	 * Dodaje do stosu skrypt z pliku
	 * @param string $src źródło
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param boolean $prepend dodaj na początek stosu
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function setFile($src, $type = 'text/javascript', array $params = array(), $prepend = false, $conditional = '') {
		$params = array_merge($params, array('type' => $type, 'src' => $src, 'crc' => $this->_getCrc($src)));
		return $this->headScript($params, $prepend, $conditional);
	}

	/**
	 * Dodaje na koniec stosu treść skryptu
	 * @param string $script zawartość skryptu
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function appendScript($script, $type = 'text/javascript', array $params = array(), $conditional = '') {
		return $this->setScript($script, $type, $params, false, $conditional);
	}

	/**
	 * Dodaje na początek stosu treść skryptu
	 * @param string $script zawartość skryptu
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function prependScript($script, $type = 'text/javascript', array $params = array(), $conditional = '') {
		return $this->setScript($script, $type, $params, true, $conditional);
	}

	/**
	 * Dodaje do stosu treść skryptu
	 * @param string $script zawartość skryptu
	 * @param string $type typ
	 * @param array $params dodatkowe parametry
	 * @param boolean $prepend dodaj na początek stosu
	 * @param string $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadScript
	 */
	public function setScript($script, $type = 'text/javascript', array $params = array(), $prepend = false, $conditional = '') {
		$params = array_merge($params, array('type' => $type, 'script' => $script, 'crc' => 0));
		return $this->headScript($params, $prepend, $conditional);
	}

}
