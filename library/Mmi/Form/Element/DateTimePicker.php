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
 * Mmi/Form/Element/DateTimePicker.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Ernest Wojciuk <ernest@wojciuk.com>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu wyboru daty i czasu
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_DateTimePicker extends Mmi_Form_Element_Text {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_View::getInstance();
		if (isset($this->_options['format'])) {
			$format = $this->_options['format'];
			unset($this->_options['format']);
		} else {
			$format = '%Y-%m-%d %H:%i:00';
		}
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/anytimec.js');
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/anytimec.css');

		$html = '<div class="field"><input data-format="' . $format . '" data-id="' . $this->id . '" class="datetimeField" ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/>';
		$html .= '<input type="button" class="clear-anytimec" data-id="' . $this->id . '" id="' . $this->id . 'Clear" value="wyczyść" />';
		$html .= '<div id="' . $this->id . 'DateTime"></div></div>';

		return $html;
	}

}