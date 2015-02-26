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
 * Mmi/Form/Element/Label.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2011 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa elementu label (zdegradowane pole)
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Form\Element;

class Label extends ElementAbstract {

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		$this->_options['labelPostfix'] = '';
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		return '';
	}

}
