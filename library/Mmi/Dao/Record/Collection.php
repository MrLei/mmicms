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
 * Mmi/Dao/Record/Collection.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Kolekcja rekordów DAO
 * @see ArrayObject
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Dao_Record_Collection extends ArrayObject {

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
	 * @return Mmi_Dao_Record_Collection
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

}
