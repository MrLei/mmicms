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
 * Mmi/Http/Cookie.php
 * @category   Mmi
 * @package    Mmi_Http
 * @subpackage Mmi_Http_Cookie
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa obsługi ciasteczek
 * @category   Mmi
 * @package    Mmi_Http
 * @subpackage Mmi_Http_Cookie
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Http_Cookie {

	/**
	 * Przechowuje informacje o ciasteczku
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Jeśli podany jest parametr nazwy ciasteczka, jest ono tworzone
	 *
	 * @param string $name nazwa
	 * @param string $value wartość
	 * @param string $domain domena
	 * @param int $expire czas wygaśnięcia
	 * @param string $path ścieżka
	 * @param boolean $secure czy zabezpieczone
	 * @param boolean $httpOnly czy tylko dla HTTP
	 */
	public function __construct($name = null, $value = null, $domain = null, $expire = 0, $path = '/', $secure = false, $httpOnly = false) {
		if (!is_null($name)) {
			setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
		}
		$this->_options['name'] = $name;
		$this->_options['value'] = $value;
		$this->_options['domain'] = $domain;
		$this->_options['expire'] = $expire;
		$this->_options['path'] = $path;
		$this->_options['secure'] = $secure;
		$this->_options['httpOnly'] = $httpOnly;
	}

	/**
	 * Ładuje ciasteczko po nazwie, zwraca czy sukces
	 * @param string $name nazwa
	 * @return boolean
	 */
	public function match($name) {
		$this->_options['value'] = isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
		if ($this->_options['value'] !== null) {
			$this->_options['name'] = $name;
			return true;
		}
		return false;
	}

	/**
	 * Pobiera nazwę
	 * @return string
	 */
	public function getName() {
		return $this->_options['name'];
	}

	/**
	 * Pobiera wartość
	 * @return string
	 */
	public function getValue() {
		return $this->_options['value'];
	}

	/**
	 * Pobiera domenę
	 * @return string
	 */
	public function getDomain() {
		return $this->_options['domain'];
	}

	/**
	 * Pobiera ścieżkę
	 * @return string
	 */
	public function getPath() {
		return $this->_options['path'];
	}

	/**
	 * Pobiera czas wygaśnięcia
	 * @return int
	 */
	public function getExpiryTime() {
		return $this->_options['expire'];
	}

	/**
	 * Czy zabezpieczone
	 * @return boolean
	 */
	public function isSecure() {
		return $this->_options['secure'];
	}

	/**
	 * Czy wygasłe
	 * @return boolean
	 */
	public function isExpired($time = null) {
		$time = ((null === $time) ? time() : $time);
		return (($this->_options['expire'] - $time) > 0);
	}

	/**
	 * Usuwa ciastko
	 * @return boolean
	 */
	public function delete() {
		unset($_COOKIE);
		return setcookie($this->getName(), null, time() - 3600, '/');
	}

}
