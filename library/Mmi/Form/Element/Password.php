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
 * Mmi/Form/Element/Password.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa elementu hasło (password)
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Form\Element;

class Password extends ElementAbstract {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$html = '<input ';
		$html .= 'type="password" ' . $this->_getHtmlOptions() . '/>';
		return $html;
	}

}
