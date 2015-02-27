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
 * Mmi/Dao/Record/Collection.php
 * @category   Mmi
 * @package    \Mmi\Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Kolekcja rekordów DAO
 * @see \ArrayObject
 * @category   Mmi
 * @package    \Mmi\Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Dao\Record;

class Collection extends \ArrayObject {

	/**
	 * Kasuje całą kolekcję obiektów
	 * @return integer ilość usuniętych obiektów
	 */
	public function delete() {
		$i = 0;
		foreach ($this as $ar) {
			$ar->delete();
			$i++;
		}
		return $i;
	}

	/**
	 * Zwraca kolekcję w postaci tablicy
	 * @return array
	 */
	public function toArray() {
		$array = array();
		foreach ($this as $key => $record) {
			$array[$key] = $record->toArray();
		}
		return $array;
	}

	/**
	 * Zwraca kolekcję w postaci tablicy obiektów
	 * @return \Mmi\Dao\Record\Collection
	 */
	public function toObjectArray() {
		$array = array();
		foreach ($this as $key => $record) {
			$array[$key] = $record;
		}
		return $array;
	}

	/**
	 * Zwraca kolekcję w postaci JSON
	 * @return string
	 */
	public function toJson() {
		return json_encode($this->toArray());
	}

	/**
	 * Klonuje całą kolekcję
	 */
	public function __clone() {
		foreach ($this as $key => $record) {
			$this[$key] = clone $record;
		}
	}

}
