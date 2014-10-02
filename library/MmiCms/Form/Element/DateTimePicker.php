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
 * MmiCms/Form/Element/DateTimePicker.php
 * @category   MmiCms
 * @package    MmiCms_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Ernest Wojciuk <ernest@wojciuk.com>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu wyboru daty i czasu
 * @category   MmiCms
 * @package    MmiCms_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class MmiCms_Form_Element_DateTimePicker extends MmiCms_Form_Element_DatePicker {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_Controller_Front::getInstance()->getView();
		$format = isset($this->_options['format']) ? $this->_options['format'] : 'Y-m-d H:i';
		$dateStart = isset($this->_options['dateStart']) ? $this->_options['dateStart'] : 'false';
		$dateEnd = isset($this->_options['dateEnd']) ? $this->_options['dateEnd'] : 'false';
		$datepicker = isset($this->_options['datepicker']) ? $this->_options['datepicker'] : 'true';
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/datetimepicker.css');
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/datetimepicker.js');
		$view->headScript()->appendScript("$(document).ready(function () {
				$('#$this->id').datetimepicker({'lang':'pl', step: 15, dateStart: '$dateStart', dateEnd: '$dateEnd', datepicker: '$datepicker', format:'$format', validateOnBlur: true, closeOnDateSelect: false});
			});
		");
		unset($this->_options['startDate']);
		unset($this->_options['endDate']);
		unset($this->_options['format']);
		unset($this->_options['datepicker']);
		$html = '<div class="field"><input id="' . $this->id . '" class="datePickerField dp-applied" ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/></div>';

		return $html;
	}

}