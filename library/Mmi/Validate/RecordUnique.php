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
 * Mmi/Validate/RecordUnique.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji unikalności rekordu w danym DAO
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
		$q = Mmi_Dao_Query::factory($dao)
				->where($field)->equals($value);
		if (isset($this->_options[2])) {
			$q->andField('id')->notEquals(intval($this->_options[2]));
		}
		if ($q->count() > 0) {
			$this->_error(self::EXISTS);
			return false;
		}
		return true;
	}

}
