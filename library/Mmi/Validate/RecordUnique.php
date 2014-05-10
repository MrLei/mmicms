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
 * Mmi/Validate/RecordUnique.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji unikalności rekordu w danym DAO
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_RecordUnique extends Mmi_Validate_Abstract {

	/**
	 * Komunikat istnienia pola
	 */
	const EXISTS = 'Pole o takiej wartości już istnieje';

	/**
	 * Walidacja unikalności rekordu w danym DAO
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		if (!isset($this->_options[0])) {
			throw new Exception('No dao class supplied.');
		}
		$dao = $this->_options[0];
		if (!is_subclass_of($dao, 'Mmi_Dao')) {
			throw new Exception('Invalid dao class supplied.');
		}
		if (!isset($this->_options[1])) {
			throw new Exception('No field name supplied.');
		}
		$field = $this->_options[1];
		/* @var $q Mmi_Dao_Query */
		$q = $dao::newQuery()
				->where($field)->equals($value);
		if (isset($this->_options[2])) {
			$q->andField('id')->notEquals(intval($this->_options[2]));
		}
		if ($dao::count($q) > 0) {
			$this->_error(self::EXISTS);
			return false;
		}
		return true;
	}

}
