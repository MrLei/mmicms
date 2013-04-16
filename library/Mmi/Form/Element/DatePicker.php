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

	public function init() {
		$this->_options['validators'] = array(
		array(
			'validator' => 'Date'
		));
	}

	public function fetchField() {
		$view = Mmi_View::getInstance();
		if (!isset($this->_options['startDate'])) {
			$this->_options['startDate'] = date('Y-m-d', time() - 100 * 365 * 86400);
		}
		if (!isset($this->_options['endDate'])) {
			$this->_options['endDate'] = date('Y-m-d', time() + 10 * 365 * 86400);
		}
        if (!isset($this->_options['format'])) {
			$this->_options['format'] = 'yyyy-mm-dd';
		}
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/date.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/datePicker.js');

        if (!$this->value && !(isset($this->_options['emptyValue'])&&$this->_options['emptyValue']===true)) {
			$this->value = date('Y-m-d');
            $blur = '$(this).blur();';
            $actions = '';
		}else{
            $blur = '';
            //na razie takie blokowanie wpisywania, bo kalendarzyk się wywali po wpisaniu niepoprawnej daty
            //najlepiej zastapić kalendarzykiem z jQ UI, ma możliwość kasowania daty i blokuje wpisywanie domyślnie
            $actions = '
            $("#' . $this->id . '").keyup(function () {
				$(this).attr("value", "");
			});
             $("#' . $this->id . '").keypress(function () {
				$(this).attr("value", "");
			});';
        }
		$view->headScript()->appendScript('$(document).ready(function() {
			Date.format = "' . $this->_options['format'] . '";
			$.dpText = {
				TEXT_PREV_YEAR		:	"' . $view->_('Poprzedni rok') . '",
				TEXT_PREV_MONTH		:	"' . $view->_('Poprzedni miesiąc') . '",
				TEXT_NEXT_YEAR		:	"' . $view->_('Następny rok') . '",
				TEXT_NEXT_MONTH		:	"' . $view->_('Następny miesiąc') . '",
				TEXT_CLOSE			:	"' . $view->_('Zamknij') . '",
				TEXT_CHOOSE_DATE	:	"' . $view->_('Wybierz datę') . '"
			}
			$("#' . $this->id . '").datePicker({
				startDate: "' . $this->_options['startDate'] . '",
				endDate: "' .$this->_options['endDate']. '"
			}).val("' . $this->value . '").trigger("change");
			$("#' . $this->id . '").focus(function () {
				'.$blur.'
				$(this).next("a.dp-choose-date").click();
			});
            '.$actions.'
		});
		');
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/datepicker.css');
		unset($this->_options['startDate']);
		unset($this->_options['endDate']);
		unset($this->_options['format']);
		$html = '<div class="field"><input id="' . $this->id . '" class="datePickerField dp-applied" ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/></div>';

		return $html;
	}

}