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
 * Mmi/Form/Element/Textarea.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu tekst wieloliniowy (textarea)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Textarea extends Mmi_Form_Element_Abstract {

	public function init() {
		if (!isset($this->_options['rows'])) {
			$this->_options['rows'] = 10;
		}
		if (!isset($this->_options['cols'])) {
			$this->_options['cols'] = 60;
		}
	}

	public function fetchField() {
		$value = isset($this->_options['value']) ? $this->_options['value'] : null;
		$filter = $this->_getFilter('Input');
		$value = $filter->filter($value);
		unset($this->_options['value']);
		$html = '<textarea ' . $this->_getHtmlOptions() . '>' . $value . '</textarea>';
		return $html;
	}

}
