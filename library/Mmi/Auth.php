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
 * Mmi/Auth.php
 * @category   Mmi
 * @package    \Mmi\Auth
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa autoryzacji
 * @category   Mmi
 * @package    \Mmi\Auth
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Auth {

	/**
	 * Przestrzeń nazw w sesji przeznaczona dla autoryzacji
	 * @var string
	 */
	private $_namespace = 'Auth';

	/**
	 * Nazwa modelu
	 * @var string
	 */
	private $_modelName;

	/**
	 * Przestrzeń w sesji
	 * @var \Mmi\Session\Namespace
	 */
	private $_session;

	/**
	 * Identyfikator użytkownika (np. login)
	 * @var string
	 */
	private $_identity;

	/**
	 * Ciąg uwierzytelniający (np. hasło)
	 * @var string
	 */
	private $_credential;

	/**
	 * Sól (unikalny dla każdej aplikacji)
	 * @var string
	 */
	private $_salt;

	/**
	 * Kostruktor, tworzy przestrzeń w sesji
	 */
	public function __construct() {
		$this->_session = new \Mmi\Session\Space($this->_namespace);
	}

	/**
	 * Ustawia sól
	 * @param string $salt
	 * @return \Mmi\Auth
	 */
	public function setSalt($salt) {
		$this->_salt = $salt;
		return $this;
	}

	/**
	 * Zwraca sól
	 * @return string
	 * @throws Exception
	 */
	public function getSalt() {
		if ($this->_salt === null) {
			throw new Exception('Salt not set, set the proper salt.');
		}
		return $this->_salt;
	}

	/**
	 * Pozwala automatycznie zalogować użytkownika przez dany czas
	 * @param int $time
	 */
	public function rememberMe($time) {
		if ($this->hasIdentity()) {
			new \Mmi\Http\Cookie('remember', 'id=' . $this->getId() . '&key='. md5($this->getSalt() . $this->getId()), null, time() + $time);
		}
	}

	/**
	 * Usuwa pamięć o automatycznym logowaniu użytkownika
	 * @return \Mmi\Auth
	 */
	public function forgetMe() {
		$cookie = new \Mmi\Http\Cookie();
		$cookie->match('remember');
		$cookie->delete();
		return $this;
	}

	/**
	 * Sprawdza czy użytkownik posiada tożsamość
	 * @return boolean
	 */
	public function hasIdentity() {
		if (!isset($this->_session->id) || !$this->_session->id) {
			return false;
		}
		return true;
	}

	/**
	 * Pobiera rolę
	 * @return string
	 */
	public function getRoles() {
		return isset($this->_session->roles) ? $this->_session->roles : array('guest');
	}

	/**
	 * Sprawdza istnienie roli
	 * @param mixed $role rola
	 * @return bool
	 */
	public function hasRole($role) {
		return in_array($role, $this->getRoles());
	}

	/**
	 * Pobiera nazwę zalgowanego użytkownika
	 * @return string | null
	 */
	public function getUsername() {
		return isset($this->_session->username) ? $this->_session->username : null;
	}

	/**
	 * Pobiera email zalogowanego użytkownika
	 * @return string | null
	 */
	public function getEmail() {
		return isset($this->_session->email) ? $this->_session->email : null;
	}

	/**
	 * Zwraca przestrzeń w sesji
	 * @return \Mmi\Session\Namespace
	 */
	public function getSessionNamespace() {
		return $this->_session;
	}

	/**
	 * Ustawia nazwę modelu
	 * @param string $modelName
	 * @return \Mmi\Auth
	 */
	public function setModelName($modelName) {
		$this->_modelName = $modelName;
		return $this;
	}

	/**
	 * Pobiera identyfikator użytkownika, lub null jeśli brak
	 * @return mixed
	 */
	public function getId() {
		return ($this->hasIdentity()) ? $this->_session->id : null;
	}

	/**
	 * Ustawia identyfikator do autoryzacji (np. login)
	 * @param string $identity identyfikator
	 * @return \Mmi\Auth
	 */
	public function setIdentity($identity) {
		$this->_identity = $identity;
		return $this;
	}

	/**
	 * Ustawia ciąg uwierzytelniający do autoryzacji (np. hasło)
	 * @param string $credential ciąg uwierzytelniający
	 * @return \Mmi\Auth
	 */
	public function setCredential($credential) {
		$this->_credential = $credential;
		return $this;
	}

	/**
	 * Czyści tożsamość
	 * @param bool $cookies czyści także ciastka zapamiętujące użytkownika
	 * @return \Mmi\Auth
	 */
	public function clearIdentity($cookies = true) {
		if ($cookies) {
			$this->forgetMe();
		}
		if ($this->_modelName) {
			$model = $this->_modelName;
			$model::deauthenticate();
		}
		$this->_session->unsetAll();
		return $this;
	}

	/**
	 * Autoryzacja
	 * @return boolean
	 */
	public function authenticate() {
		$model = $this->_modelName;
		if (!$this->_modelName) {
			return false;
		}
		$result = $model::authenticate($this->_identity, $this->_credential);
		if ($result === false) {
			return false;
		}
		if (!is_object($result)) {
			throw new Exception('Authentication result is not an instance of stdClass');
		}
		return $this->setAuthentication($result->id, $result->username, $result->email, $result->roles, $result->lang, \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress);
	}
	
	/**
	 * Wymuszenie ustawienia autoryzacji
	 * @param integer $id
	 * @param string $username
	 * @param string $email
	 * @param array $roles
	 * @param string $lang
	 * @param string $ip
	 * @return boolean
	 */
	public function setAuthentication($id, $username, $email, array $roles = array('guest'), $lang = null, $ip = null) {
		$this->_session->id = $id;
		$this->_session->username = $username;
		$this->_session->email = $email;
		$this->_session->lang = $lang;
		$this->_session->roles = $roles;
		$this->_session->ip = $ip;
		return true;
	}

	/**
	 * Zaufana autoryzacja
	 * @return boolean
	 */
	public function idAuthenticate() {
		$model = $this->_modelName;
		$result = $model::idAuthenticate($this->_identity);
		if (!is_object($result)) {
			throw new Exception('Authentication result is not an instance of stdClass');
		}
		return $this->setAuthentication($result->id, $result->username, $result->email, $result->roles, $result->lang, \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress);
	}

	/**
	 * Uwierzytelnienie przez http
	 * @param string $realm identyfikator przestrzeni chronionej
	 * @param string $errorMessage treść komunikatu zwrotnego - błędnego
	 */
	public function httpAuth($realm = '', $errorMessage = '') {
		$identity = \Mmi\Controller\Front::getInstance()->getEnvironment()->authUser;
		$credential = \Mmi\Controller\Front::getInstance()->getEnvironment()->authPassword;

		$this->setIdentity($identity);
		$this->setCredential($credential);
		$model = $this->_modelName;
		$result = $model::authenticate($identity, $credential);
		if ($result === false) {
			\Mmi\Controller\Front::getInstance()->getResponse()
				->setHeader('WWW-Authenticate', 'Basic realm="' . $realm . '"')
				->setCodeForbidden()
				->setContent($errorMessage)
				->send();
			exit;
		}
	}

}
