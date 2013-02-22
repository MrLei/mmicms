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
 * Mmi/Form/Element/Text.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu tekst (text)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Text extends Mmi_Form_Element_Abstract {

	/**
	 * Filtracja niedozwolonych znaków
	 */
	public function preRender() {
		$this->addFilter('Input');
	}

	public function fetchField() {
		if (isset($this->_options['value'])) {
			$filter = $this->_getFilter('Input');
			$this->_options['value'] = $filter->filter($this->_options['value']);
		}
		$html = '<input ';
		$html .= 'type="text" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}