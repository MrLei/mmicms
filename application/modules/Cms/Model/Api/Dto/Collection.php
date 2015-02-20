<?php


namespace Cms\Model\Api\Dto;

class Collection extends ArrayObject {

	/**
	 * Konstruktor ustawiający kolekcję na podstawie tablicy obiektów lub tablic
	 * @param mixed $data
	 */
	public function __construct($data = null) {
		if ($data === null) {
			return;
		}
		if ($data instanceof \Mmi\Dao\Record\Collection) {
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
	 * @return Cms\Model\Api\Dto\Collection
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
	 * @param \Mmi\Dao\Record\Collection $data kolekcja obiektów DAO
	 * @return Api\Model\Dto\Collection
	 */
	public final function setFromDaoRecordCollection(\Mmi\Dao\Record\Collection $data) {
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
		if ($dtoClass == 'Cms\Model\Api\Dto') {
			throw new Exception('Cms\Model\Api\Dto\Collection: Invalid DTO object name');
		}
		return $dtoClass;
	}

}
