<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Validate;

class RecordUnique extends ValidateAbstract {

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
			throw new\Exception('No dao class supplied.');
		}
		$dao = $this->_options[0];
		if (!is_subclass_of($dao, '\Mmi\Dao')) {
			throw new\Exception('Invalid dao class supplied.');
		}
		if (!isset($this->_options[1])) {
			throw new\Exception('No field name supplied.');
		}
		$field = $this->_options[1];
		/* @var $q \Mmi\Dao\Query */
		$q = \Mmi\Dao\Query::factory($dao)
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
