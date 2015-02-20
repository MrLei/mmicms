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
 * MmiCms/Form/Element/ColorPicker.php
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu wyboru koloru
 * @category   MmiCms
 * @package    MmiCms\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
namespace MmiCms\Form\Element;

class ColorPicker extends \Mmi\Form\Element\Text {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = \Mmi\Controller\Front::getInstance()->getView();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/farbtastic.js');
		$view->headScript()->appendScript('
			$(document).ready(function() {
				$(\'#' . $this->id . 'Picker\').farbtastic(\'#' . $this->id . '\');
			});
		');
		$this->readonly = 'readonly';
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/farbtastic.css');
		if (!$this->value) {
			$this->value = '#ffffff';
		}
		$html = '<input class="colorField" ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/><div id="' . $this->id . 'Picker"></div>';
		return $html;
	}

}