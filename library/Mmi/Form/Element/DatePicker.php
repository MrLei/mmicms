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
 * Mmi/Form/Element/DatePicker.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu wyboru daty, można podać opcje: startDate, endDate, format
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_DatePicker extends Mmi_Form_Element_Abstract {

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		$this->addValidatorDate();
	}

	/**
	 * Ustawia datę startową
	 * @param string $date - sformatowany string czasu
	 * @return Mmi_Form_Element_DatePicker
	 */
	public function setDateStart($date) {
		$this->_options['dateStart'] = $date;
		return $this;
	}

	/**
	 * Ustawia datę końcową
	 * @param string $date - sformatowany string czasu
	 * @return Mmi_Form_Element_DatePicker
	 */
	public function setDateEnd($date) {
		$this->_options['dateEnd'] = $date;
		return $this;
	}

	/**
	 * Ustawia format daty
	 * @param string $format
	 * @return Mmi_Form_Element_DatePicker
	 */
	public function setFormat($format) {
		$this->_options['format'] = $format;
		return $this;
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_Controller_Front::getInstance()->getView();
		$format = isset($this->_options['format']) ? $this->_options['format'] : 'Y-m-d';
		$dateStart = isset($this->_options['dateStart']) ? $this->_options['dateStart'] : 'false';
		$dateEnd = isset($this->_options['dateEnd']) ? $this->_options['dateEnd'] : 'false';
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/datetimepicker.css');
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/datetimepicker.js');
		$view->headScript()->appendScript("$(document).ready(function () {
				$('#$this->id').datetimepicker({timepicker: false, dateStart: '$dateStart', dateEnd: '$dateEnd', format:'$format', 'lang':'pl', mask:true, closeOnDateSelect: true});
			});
		");
		unset($this->_options['startDate']);
		unset($this->_options['endDate']);
		unset($this->_options['format']);
		$html = '<div class="field"><input id="' . $this->id . '" class="datePickerField dp-applied" ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/></div>';

		return $html;
	}

}