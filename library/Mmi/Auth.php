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
 * Mmi/Auth.php
 * @category   Mmi
 * @package    Mmi_Auth
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa autoryzacji
 * @category   Mmi
 * @package    Mmi_Auth
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Auth {

	/**
	 * Instancja
	 * @var Mmi_Auth
	 */
	private static $_instance;

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
	 * @var Mmi_Session_Namespace
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
	 * Pobiera instancję
	 * @return Mmi_Auth
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Kostruktor, tworzy przestrzeń w sesji
	 */
	protected function __construct() {
		$this->_session = new Mmi_Session_Namespace($this->_namespace);
	}

	/**
	 * Pozwala automatycznie zalogować użytkownika przez dany czas
	 * @param int $time
	 */
	public function rememberMe($time) {
		if ($this->hasIdentity()) {
			new Mmi_Http_Cookie('remember', 'id=' . $this->getId() . '&key='. md5(Mmi_Config::get('global', 'salt') . $this->getId()), null, time() + $time);
		}
	}

	/**
	 * Usuwa pamięć o automatycznym logowaniu użytkownika
	 */
	public function forgetMe() {
		$cookie = new Mmi_Http_Cookie();
		$cookie->match('remember');
		$cookie->delete();
	}

	/**
	 * Sprawdza czy użytkownik posiada tożsamość
	 * @return boolean
	 */
	public function hasIdentity() {
		if (!isset($this->_session->id) || !($this->_session->id > 0)) {
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
	 * @return Mmi_Session_Namespace
	 */
	public function getSessionNamespace() {
		return $this->_session;
	}

	/**
	 * Ustawia nazwę modelu
	 * @param string $modelName
	 */
	public function setModelName($modelName) {
		if (!is_subclass_of($modelName, 'Mmi_Auth_Model_Interface')) {
			throw new Exception('Authorization model does not implement Mmi_Auth_Model_Interface');
		}
		$this->_modelName = $modelName;
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
	 */
	public function setIdentity($identity) {
		$this->_identity = $identity;
	}

	/**
	 * Ustawia ciąg uwierzytelniający do autoryzacji (np. hasło)
	 * @param string $credential ciąg uwierzytelniający
	 */
	public function setCredential($credential) {
		$this->_credential = $credential;
	}

	/**
	 * Czyści tożsamość
	 * @param bool $cookies czyści także ciastka zapamiętujące użytkownika
	 */
	public function clearIdentity($cookies = true) {
		if ($cookies) {
			$this->forgetMe();
		}
		$model = $this->_modelName;
		$model::deauthenticate();
		$this->_session->unsetAll();
	}

	/**
	 * Autoryzacja, zwraca wynik, lub false
	 * @return mixed
	 */
	public function authenticate() {
		$model = $this->_modelName;
		$result = $model::authenticate($this->_identity, $this->_credential);
		if ($result === false) {
			return false;
		}
		if (!is_object($result)) {
			throw new Exception('Authentication result is not an instance of stdClass');
		}
		$this->_session->id = $result->id;
		$this->_session->username = $result->username;
		$this->_session->email = $result->email;
		$this->_session->lang = $result->lang;
		$this->_session->roles = $result->roles;
		$this->_session->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
		return true;
	}

	public function idAuthenticate() {
		$model = $this->_modelName;
		$result = $model::idAuthenticate($this->_identity);
		if (is_object($result)) {
			$this->_session->id = $result->id;
			$this->_session->username = $result->username;
			$this->_session->email = $result->email;
			$this->_session->lang = $result->lang;
			$this->_session->roles = $result->roles;
			$this->_session->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
		}
		return true;
	}

	public function httpAuth($realm = '', $errorMessage = '') {
		$identity = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
		$credential = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

		$this->setIdentity($identity);
		$this->setCredential($credential);
		$result = $this->authenticate();
		if ($identity == '' || $credential == '' || !$result) {
			header('WWW-Authenticate: Basic realm="' . $realm . '"');
			header('HTTP/1.0 401 Unauthorized');
			die($errorMessage);
		}
	}

}
