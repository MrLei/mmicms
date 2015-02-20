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
 * Mmi/Acl.php
 * @category   Mmi
 * @package    \Mmi\Acl
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */


namespace Mmi;

class Acl {

	/**
	 * Zasoby
	 * @var array
	 */
	private $_resources = array();

	/**
	 * Role
	 * @var array
	 */
	private $_roles = array();

	/**
	 * Uprawnienia
	 * @var array
	 */
	private $_rights = array();

	/**
	 * Dodaje zasób
	 * @param string $resource zasób
	 */
	public function add($resource) {
		$this->_resources[$resource] = true;
	}

	/**
	 * Sprawdza istnienie zasobu
	 * @param string $resource zasób
	 */
	public function has($resource) {
		return isset($this->_resources[$resource]);
	}

	/**
	 * Dodaje rolę
	 * @param string $role rola
	 */
	public function addRole($role) {
		if (!isset($this->_roles[$role])) {
			$this->_roles[$role] = true;
		}
	}

	/**
	 * Sprawdza istnienie roli
	 * @param string $role rola
	 */
	public function hasRole($role) {
		return isset($this->_roles[$role]);
	}

	/**
	 * Ustawia pozwolenie na dostęp roli do zasobu
	 * @param string $role rola
	 * @param string $resource zasób
	 */
	public function allow($role, $resource) {
		$this->addRole($role);
		$this->_rights[$role . ':' . $resource] = true;
	}

	/**
	 * Ustawia zakaz dostępu roli do zasobu
	 * @param string $role rola
	 * @param string $resource zasób
	 */
	public function deny($role, $resource) {
		$this->addRole($role);
		$this->_rights[$role . ':' . $resource] = false;
	}

	/**
	 * Sprawdza dostęp grupy ról do zasobu
	 * @param string $roles tablica ról
	 * @param string $resource zasób
	 * @return boolean
	 */
	public function isAllowed($roles, $resource) {
		$allowed = false;
		foreach ($roles as $role) {
			if ($this->isRoleAllowed($role, $resource)) {
				$allowed = true;
				break;
			}
		}
		return $allowed;
	}

	/**
	 * Sprawdza dostęp roli do zasobu
	 * @param string $role rola
	 * @param string $resource zasób
	 * @return boolean
	 */
	public function isRoleAllowed($role, $resource) {
		if (isset($this->_rights[$role . ':' . $resource])) {
			return $this->_rights[$role . ':' . $resource];
		} elseif (strrpos($resource, ':') !== false) {
			return $this->isRoleAllowed($role, substr($resource, 0, strrpos($resource, ':')));
		} elseif (isset($this->_rights[$role . ':'])) {
			return $this->_rights[$role . ':'];
		}
		return false;
	}

}