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
 * Mmi/Validate/Abstract.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa walidacji
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Validate_Abstract {

	/**
	 * Wiadomość
	 * @var string
	 */
	protected $_error;

	/**
	 * Opcje
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Konstruktor, ustawia opcje
	 * @param array $options opcje
	 */
	public final function __construct(array $options = array()) {
		$this->setOptions($options);
	}
	
	/**
	 * Ustawienie opcji
	 * @param array $options 
	 */
	public final function setOptions(array $options = array()) {
		$this->_options = $options;
	}

	/**
	 * Abstrakcyjna funkcja sprawdzająca poprawność wartości
	 * @param mixed $value wartość
	 */
	public abstract function isValid($value);

	/**
	 * Pobiera błąd
	 * @return string
	 */
	public final function getError() {
		return $this->_error;
	}

	/**
	 * Ustawia błąd
	 * @param string $message
	 */
	protected final function _error($message) {
		$this->_error = $message;
	}

}