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
 * Mmi/Form/Element/Textarea.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu tekst wieloliniowy (textarea)
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Form\Element;

class Textarea extends ElementAbstract {
	
	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		if (!isset($this->_options['rows'])) {
			$this->_options['rows'] = 10;
		}
		if (!isset($this->_options['cols'])) {
			$this->_options['cols'] = 60;
		}
	}
	
	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$value = isset($this->_options['value']) ? $this->_options['value'] : null;
		$filter = $this->_getFilter('Input');
		$value = $filter->filter($value);
		unset($this->_options['value']);
		$html = '<textarea ' . $this->_getHtmlOptions() . '>' . $value . '</textarea>';
		return $html;
	}

}
