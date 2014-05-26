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
 * Mmi/View/Helper/HeadStyle.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Helper styli tekstowych w nagłówku strony
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_View_Helper_HeadStyle extends Mmi_View_Helper_Abstract {

	/**
	 * Dane
	 * @var array
	 */
	private $_data = array();

	/**
	 * Metoda główna, dodaje styl do stosu
	 * @param array $params
	 * @param boolean $prepend
	 * @param string $conditional
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function headStyle(array $params = null, $prepend = false, $conditional = '') {
		if (is_array($params)) {
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
	 * Renderer styli
	 * @return string
	 */
	public function __toString() {
		$html = '';
		foreach ($this->_data as $style) {
			if (isset($style['style'])) {
				$styleContent = $style['style'];
				unset($style['style']);
			}
			$conditional = $style['conditional'];
			unset($style['conditional']);
			if ($conditional) {
				$html .= '<!--[if ' . $conditional . ']>';
			}
			$html .= '<style ';
			foreach ($style as $key => $value) {
				$html .= $key. '="' . $value . '" ';
			}
			$html = rtrim($html);
			$html .= '>';
			if (isset($styleContent)) {
				$html .= PHP_EOL . '/* <![CDATA[ */' . PHP_EOL . $styleContent . PHP_EOL . '/* ]]> */';
				unset($styleContent);
			}
			$html .= '</style>';
			if ($conditional) {
				$html .= '<![endif]-->';
			}
			$html .= PHP_EOL;
		}
		return $html;
	}
	
	/**
	 * Dodaje na koniec stosu treść css
	 * @param string $style treść skryptu
	 * @param array $params parametry dodatkowe
	 * @param boolean $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function appendStyle($style, array $params = array(), $conditional = '') {
		return $this->setStyle($style, $params, false, $conditional);
	}
	
	/**
	 * Dodaje na koniec stosu treść pliku css
	 * @param string $fileName nazwa pliku ze skryptem
	 * @param array $params parametry dodatkowe
	 * @param boolean $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function appendStyleFile($fileName, array $params = array(), $conditional = '') {
		return $this->appendStyle($this->_getStyleContent($fileName), $params, $conditional);
	}

	/**
	 * Dodaje na początek stosu treść pliku css
	 * @param string $fileName nazwa pliku ze skryptem
	 * @param array $params parametry dodatkowe
	 * @param boolean $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function prependStyleFile($fileName, array $params = array(), $conditional = '') {
		return $this->appendStyle($this->_getStyleContent($fileName), $params, $conditional);
	}

	/**
	 * Dodaje na początek stosu treść css
	 * @param string $style treść skryptu
	 * @param array $params parametry dodatkowe
	 * @param boolean $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function prependStyle($style, array $params = array(), $conditional = '') {
		return $this->setStyle($style, $params, true, $conditional);
	}

	/**
	 * Dodaje do stosu treść skryptu
	 * @param string $style treść skryptu
	 * @param array $params parametry dodatkowe
	 * @param boolean $prepend dodaj na początek stosu
	 * @param boolean $conditional warunek np. ie6
	 * @return Mmi_View_Helper_HeadStyle
	 */
	public function setstyle($style, array $params = array(), $prepend = false, $conditional = '') {
		$params = array_merge($params, array('type' => 'text/css', 'style' => $style));
		return $this->headStyle($params, $prepend, $conditional);
	}
	
	/**
	 * Pobiera zawartość CSS
	 * @param string $fileName
	 * @return string
	 */
	protected function _getStyleContent($fileName) {
		$cache = $this->view->getCache();
		$cacheKey = 'Head_Style_Css_' . md5($fileName);
		if (!$cache || (null === ($content = $cache->load($cacheKey)))) {
			$content = file_get_contents(PUBLIC_PATH . '/' . $fileName);
			$location = $this->view->baseUrl . '/' . dirname($fileName) . '/';
			$content = str_replace(array('url(\'', 'url("', "\r\n", "\n", "\t", ', ', ': ', ' {', '{ ', ' }', '} '), 
				array('url(\'' . $location, 'url("' . $location, '', '', '', ',', ':', '{', '{', '}', '}'), $content);
			$content = preg_replace('/\/\*(.[^\*]+)\*\//is', '', $content);
			$cache->save($content, $cacheKey, 864000);
		}
		return $content;
	}

}
