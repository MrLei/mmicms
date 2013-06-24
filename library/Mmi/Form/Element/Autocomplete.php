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
 * Mmi/Form/Element/Autocomplete.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu tekstowego z podpowiadaniem
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Autocomplete extends Mmi_Form_Element_Text {
	
	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$view = Mmi_View::getInstance();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/autocomplete.js');

		$match = 'mustMatch: false';
		if (isset($this->_options['mustMatch']) && $this->_options['mustMatch']) {
			$match = 'mustMatch: true';
		}

		//opcje w tabeli
		if (isset($this->_options['multiOptions']) && is_array($this->_options['multiOptions'])) {
			$multiOptionsString = '';
			foreach($this->_options['multiOptions'] as $option) {
				$multiOptionsString	.= '"' . $option . '",';
			}
			$multiOptionsString = trim($multiOptionsString, ',');

			$view->headScript()->appendScript('
				$(document).ready(function() {
					var ' . $this->id . 'Data = new Array('. $multiOptionsString .');
					$(\'#' . $this->id . '\').autocomplete(' . $this->id . 'Data);
				});
			');
		//backend skryptowy
		} elseif (isset($this->_options['backend'])) {
			$view->headScript()->appendScript('
				$(document).ready(function() {
					$(\'#' . $this->id . '\').autocomplete("' . $this->_options['backend'] . '/", {
					' . $match . '
					});
				});
			');
		}
		$view->headLink()->appendStylesheet($view->baseUrl . '/library/css/autocomplete.css');
		return parent::fetchField();
	}

}