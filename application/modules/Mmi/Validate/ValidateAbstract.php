<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Validate;

abstract class ValidateAbstract extends \Mmi\OptionObject {

	/**
	 * Wiadomość
	 * @var string
	 */
	protected $_error;

	/**
	 * Konstruktor, ustawia opcje
	 * @param array $options opcje
	 */
	public final function __construct(array $options = array()) {
		$this->setOptions($options);
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