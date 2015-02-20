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
 * Mmi/Controller/Action/Helper/Messenger.php
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Helper wiadomości (posłaniec), przechowuje wiadomości w sesji
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Controller\Action\Helper;

class Messenger extends \Mmi\Controller\Action\Helper\HelperAbstract {

	/**
	 * Przestrzeń w sesji zarezerwowana dla wiadomości
	 * @var \Mmi\Session\Space
	 */
	static protected $_session = null;

	/**
	 * Nazwa przestrzeni
	 * @var string
	 */
	private $_namespace;

	/**
	 * Obiekt tłumaczeń
	 * @var \Mmi\Translate
	 */
	private $_translate;

	/**
	 * Konstruktor pozwala zdefiniować w opcjach 'namespace' czyli nazwę przestrzeni
	 */
	public function __construct() {
		$this->_namespace = 'messenger';
		self::$_session = new \Mmi\Session\Space($this->_namespace);
	}

	/**
	 * Ustawia translator
	 * @param \Mmi\Translate $translate
	 * @return \Mmi\Controller\Action\Helper\Messenger
	 */
	public function setTranslate(\Mmi\Translate $translate) {
		$this->_translate = $translate;
		return $this;
	}

	/**
	 * Metoda główna, dodaje wiadomość
	 * @param string $message wiadomość w formacie sprintf
	 * @param bool $type true - pozytywna, null - neutralna, false - negatywna
	 * @param array $variables zawiera zmienne do sprintf
	 * @return \Mmi\Controller\Action\Helper\Messenger
	 */
	public function messenger($message, $type = null, array $variables = array()) {
		if ($this->_translate !== null) {
			$message = $this->_translate->_($message);
		}
		array_unshift($variables, $message);
		return $this->addMessage(call_user_func_array('sprintf', $variables), $type);
	}

	/**
	 * Dodaje wiadomość
	 * @param string $message wiadomość
	 * @param bool $type true - pozytywna, false - negatywna, brak - neutralna
	 * @return \Mmi\Controller\Action\Helper\Messenger
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
	 * @return \Mmi\Controller\Action\Helper\Messenger
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
