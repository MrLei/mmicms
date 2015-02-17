<?php

class Cms_Model_Api_Dto_Collection extends ArrayObject {

	/**
	 * Konstruktor ustawiający kolekcję na podstawie tablicy obiektów lub tablic
	 * @param mixed $data
	 */
	public function __construct($data = null) {
		if ($data === null) {
			return;
		}
		if ($data instanceof Mmi_Dao_Record_Collection) {
			$this->setFromDaoRecordCollection($data);
			return;
		}
		if (!is_array($data) || empty($data)) {
			return;
		}
		if (!is_array(reset($data))) {
			return parent::__construct($data);
		}
		$this->setFromArray($data);
	}

	/**
	 * Ustawia kolekcję na podstawie tablicy tablic
	 * @param array $data tablica obiektów stdClass
	 * @return Cms_Model_Api_Dto_Collection
	 */
	public final function setFromArray(array $data) {
		$dtoClass = $this->_getDtoClass();
		$this->exchangeArray(array());
		foreach ($data as $array) {
			if (!is_array($array)) {
				continue;
			}
			$this->append(new $dtoClass($array));
		}
		return $this;
	}

	/**
	 * Ustawia kolekcję na podstawie obiektu obiektów
	 * @param Mmi_Dao_Record_Collection $data kolekcja obiektów DAO
	 * @return Api_Model_Dto_Collection
	 */
	public final function setFromDaoRecordCollection(Mmi_Dao_Record_Collection $data) {
		$dtoClass = $this->_getDtoClass();
		$this->exchangeArray(array());
		foreach ($data as $record) {
			$this->append(new $dtoClass($record));
		}
		return $this;
	}

	/**
	 * Zwraca kolekcję w postaci tablicy
	 * @return array
	 */
	public final function toArray() {
		$array = array();
		foreach ($this as $key => $dto) {
			$array[$key] = $dto->toArray();
		}
		return $array;
	}

	/**
	 * Zwraca kolekcję w postaci tablicy obiektów DTO
	 * @return array
	 */
	public final function toObjectArray() {
		$array = array();
		foreach ($this as $key => $dto) {
			$array[$key] = $dto;
		}
		return $array;
	}

	/**
	 * Ustala nazwę klasy DTO
	 * @return string
	 */
	protected final function _getDtoClass() {
		$dtoClass = substr(get_class($this), 0, -11);
		if ($dtoClass == 'Cms_Model_Api_Dto') {
			throw new Exception('Cms_Model_Api_Dto_Collection: Invalid DTO object name');
		}
		return $dtoClass;
	}

}
