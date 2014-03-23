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
 * Mmi/Navigation/Config.php
 * @category   Mmi
 * @package    Mmi_Navigation
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja nawigatora
 * @category   Mmi
 * @package    Mmi_Navigation
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Navigation_Config {

	/**
	 * Dane nawigacji
	 * @var type
	 */
	protected $_data = array();
	
	/**
	 * Dodaje element nawigatora
	 * @param int $id klucz
	 * @return Mmi_Navigation_Config_Element
	 */
	public function add(Mmi_Navigation_Config_Element $element) {
		$this->_data[$element->getId()] = $element; 
		return $this;
	}

	/**
	 * Zwraca wszystkie skonfigurowane elementy
	 * @return array
	 */
	public function get() {
		$data = array();
		foreach ($this->_data as $id => $level) {
			$data[$id] = $level->toArray();
		}
		return $data;
	}

}
