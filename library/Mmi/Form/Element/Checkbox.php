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
 * Mmi/Form/Element/Checkbox.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu checkbox (zaznaczenie pojedyncze)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Checkbox extends Mmi_Form_Element_Abstract {
	
	/**
	 * Kolejność renderowania pola
	 * @var array
	 */
	protected $_renderingOrder = array(
		'fetchErrors', 'fetchField', 'fetchLabel',  'fetchDescription'
	);
	
	/**
	 * Funkcja użytkownika, jest wykonywana przed renderingiem
	 */
	public function preRender() {
		$this->_labelPostfix = '';
		if (isset($this->_options['value']) && $this->_options['value'] == 1) {
			$this->_options['checked'] = 'checked';
		} else {
			unset($this->_options['checked']);
		}
		$this->_options['value'] = '1';
	}
	
	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		return '<input type="checkbox" ' . $this->_getHtmlOptions() . '/>';
	}
	
}