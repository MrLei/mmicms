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
 * Mmi/Controller/Action/Helper/Messenger.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper wiadomości (posłaniec), przechowuje wiadomości w sesji
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Action_Helper_Messenger extends Mmi_Controller_Action_Helper_Abstract {

	/**
	 * Przestrzeń w sesji zarezerwowana dla wiadomości
	 * @var Mmi_Session_Namespace
	 */
	static protected $_session = null;

	/**
	 * Czy dodano wiadomość
	 * @var boolean
	 */
	static protected $_messageAdded = false;

	/**
	 * Nazwa przestrzeni
	 * @var string
	 */
	private $_namespace;

	/**
	 * Konstruktor pozwala zdefiniować w opcjach 'namespace' czyli nazwę przestrzeni
	 * @param array $options opcje
	 */
	public function __construct(array $options = array()) {
		$this->_namespace = isset($options['namespace']) ? $options['namespace'] : 'messenger';
		self::$_session = new Mmi_Session_Namespace($this->_namespace);
	}

	/**
	 * Metoda główna, dodaje wiadomość
	 * @param string $message wiadomość
	 * @param bool $type true - pozytywna, null - neutralna, false - negatywna
	 * @param bool $translate - sprawdza czy jest tłumaczenie
	 * @return Mmi_Session_Namespace
	 */
	public function messenger($message, $type = null, $translate = true) {
		if ($translate) {
			$message = Mmi_Registry::get('Mmi_Translate')->_($message);
		}
		return $this->addMessage($message, $type);
	}

	/**
	 * Dodaje wiadomość
	 * @param string $message wiadomość
	 * @param bool $type true - pozytywna, false - negatywna, brak - neutralna
	 * @return Mmi_Session_Namespace
	 */
	public function addMessage($message, $type = null) {
		if ($type) {
			$type = 'success';
		} elseif (false === $type) {
			$type = 'error';
		}
		$message = array('message' => $message, 'type' => $type);
		if (!is_array(self::$_session->messages)) {
			self::$_session->messages = array();
		}
		$messages = self::$_session->messages;
		$messages[] = $message;
		self::$_session->messages = $messages;
		return $this;
	}

	/**
	 * Czy są jakieś wiadomości
	 * @return boolean
	 */
	public function hasMessages() {
		return (is_array(self::$_session->messages) && !empty(self::$_session->messages));
	}

	/**
	 * Pobiera wiadomości
	 * @return array
	 */
	public function getMessages() {
		if (is_array(self::$_session->messages)) {
			$messages = self::$_session->messages;
		} else {
			$messages = array();
		}
		return $messages;
	}

	/**
	 * Czyści wiadomości
	 * @return Mmi_Session_Namespace
	 */
	public function clearMessages() {
		self::$_session->unsetAll();
		return $this;
	}

	/**
	 * Zlicza wiadomości
	 * @return int
	 */
	public function count() {
		return count(self::$_session->messages);
	}

}
