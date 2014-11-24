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
 * Mmi/Filter/Interface.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa filtra
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
abstract class Mmi_Filter_Abstract {

	/**
	 * Opcje
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Zwraca przefiltrowaną wartość
	 * @param mixed $value
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	abstract public function filter($value);

	/**
	 * Ustawia opcje - tabela klucz => wartość
	 * @param array $options opcje
	 * @return Mmi_Filter_Abstract
	 */
	public function setOptions(array $options = array()) {
		$this->_options = $options;
		return $this;
	}

	/**
	 * Ustawia pojedynczą opcję
	 * @param mixed $key klucz
	 * @param mixed $value wartość
	 * @return Mmi_Filter_Abstract
	 */
	public function setOption($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}

}
