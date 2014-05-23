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
 * Mmi/Form/Element/Checkbox.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu checkbox (zaznaczenie pojedyncze)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Form_Element_Checkbox extends Mmi_Form_Element_Abstract {

	/**
	 * Kolejność renderowania pola
	 * @var array
	 */
	protected $_renderingOrder = array(
		'fetchField', 'fetchLabel',  'fetchDescription', 'fetchErrors'
	);

	public function fetchLabel() {
		$this->_options['labelPostfix'] = '';
		return parent::fetchLabel();
	}

	public function fetchField() {
		if (isset($this->_options['value']) && $this->_options['value'] == 1) {
			$this->_options['checked'] = 'checked';
		} else {
			unset($this->_options['checked']);
		}
		$this->_options['value'] = '1';
		return '<input type="checkbox" ' . $this->_getHtmlOptions() . '/>';
	}

}