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
 * Mmi/Session.php
 * @category   Mmi
 * @package    Mmi_Session
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa sesji
 * @category   Mmi
 * @package    Mmi_Session
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Session {

	/**
	 * Zwraca czy ustawiona jest przestrzeń nazw
	 * @param  string $name nazwa przestrzeni
	 * @return boolean
	 */
	public static function namespaceIsset($name) {
		return isset($_SESSION[$name]);
	}

	/**
	 * Rozpoczęcie sesji
	 * @param array $config tabela z konfiguracją
	 */
	public static function start($config) {
		if (isset($config['name'])) {
			session_name($config['name']);
		}
		if (isset($config['cookie_lifetime'])) {
			session_set_cookie_params($config['cookie_lifetime']);
		}
		if (isset($config['cache_expire'])) {
			session_cache_expire($config['cache_expire']);
		}
		if (isset($config['gc_divisor'])) {
			ini_set('session.gc_divisor', $config['gc_divisor']);
		}
		if (isset($config['gc_maxlifetime'])) {
			ini_set('session.gc_maxlifetime', $config['gc_maxlifetime']);
		}
		if (isset($config['gc_probability'])) {
			ini_set('session.gc_probability', $config['gc_probability']);
		}
		if (isset($config['save_path'])) {
			session_save_path($config['save_path']);
		}
		if (isset($config['save_handler'])) {
			if ($config['save_handler'] == 'user') {
				$customClassName = 'Mmi_Session_Handler_' . ucfirst($config['save_path']);
				$sha = new $customClassName();
				session_set_save_handler(array($sha, 'open'), array($sha, 'close'), array($sha, 'read'), array($sha, 'write'), array($sha, 'destroy'), array($sha, 'gc'));
				register_shutdown_function('session_write_close');
			}
			ini_set('session.save_handler', $config['save_handler']);
		}
		session_start();
	}

	/**
	 * Ustawia identyfikator sesji
	 * zwraca ustawiony identyfikator
	 * @param string $id identyfikator
	 * @return string
	 */
	public static function setId($id) {
		return session_id($id);
	}

	/**
	 * Pobiera identyfikator sesji
	 * @return string
	 */
	public static function getId() {
		return session_id();
	}
	
	/**
	 * Pobiera przekształcony do integera identyfikator sesji
	 * @return int
	 */
	public static function getNumericId() {
		$hashId = self::getId();
		$id = (integer)substr(preg_replace('/[a-z]+/', '', $hashId), 0, 9);
		$letters = preg_replace('/[0-9]+/', '', $hashId);
		for ($i = 0, $length = strlen($letters); $i < $length; $i++) {
			$id += ord($letters[$i]) - 97;
		}
		return $id;
	}

	/**
	 * Niszczy sesję
	 * @return boolean
	 */
	public static function destroy() {
		return session_destroy();
	}

	/**
	 * Regeneruje identyfikator sesji
	 * kopiuje dane starej sesji do nowej
	 * @param boolean $deleteOldSession kasuje starą sesję
	 * @return boolean
	 */
	public static function regenerateId($deleteOldSession = false) {
		return session_regenerate_id($deleteOldSession);
	}

}