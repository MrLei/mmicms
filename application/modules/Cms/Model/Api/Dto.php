<?php

namespace Cms\Model\Api;

abstract class Dto {

	protected static $_replacementFields = array();
	protected static $_readOnlyFields = array('id');

	/**
	 * Konstruktor buduje DTO na podstawie tablicy lub obiektu
	 * @param mixed $data
	 */
	public function __construct($data = null) {
		if (is_array($data)) {
			return $this->setFromArray($data);
		}
		if ($data instanceof \Mmi\Dao\Record) {
			return $this->setFromDaoRecord($data);
		}
		if ($data instanceof Cms\Model\Api\Dto) {
			return $this->setFromArray($data->toArray());
		}
		//pozostałe typy danych są niewspierane
		if ($data !== null) {
			$type = gettype($data);
			if ($type === 'object') {
				$type = get_class($data);
			}
			throw new \Mmi\Json\Rpc\Data\Exception('Invalid input data: ' . $type . ' is not supported');
		}
	}

	/**
	 * Ustawia obiekt DTO na podstawie tabeli
	 * @param array $data
	 * @return Cms\Model\Api\Dto
	 */
	public final function setFromArray(array $data) {
		foreach ($data as $key => $value) {
			if (!property_exists($this, $key)) {
				continue;
			}
			$this->{$key} = $value;
		}
		foreach (static::$_replacementFields as $recordKey => $dtoKey) {
			if (!is_array($dtoKey)) {
				$dtoKey = array($dtoKey);
			}
			//obsługa wielu zastąpień z jednego klucza rekordu
			foreach ($dtoKey as $dKey) {
				if (!property_exists($this, $dKey)) {
					continue;
				}
				if (!array_key_exists($recordKey, $data)) {
					continue;
				}
				$this->$dKey = $data[$recordKey];
			}
		}
		return $this;
	}

	/**
	 * Ustawia obiekt z \Mmi\Dao\Record
	 * @param \Mmi\Dao\Record $record
	 * @return Cms\Model\Api\Dto
	 */
	public final function setFromDaoRecord(\Mmi\Dao\Record $record) {
		return $this->setFromArray($record->toArray());
	}

	/**
	 * Konwertuje DTO do tabeli (dane wyjściowe)
	 * @return array
	 */
	public final function toArray() {
		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}

	/**
	 * Konwertuje DTO do tabeli (dane wejściowe)
	 * @return array
	 */
	public final function toArrayPut() {
		$data = array();
		foreach ($this as $key => $value) {
			if (false !== in_array($key, static::$_readOnlyFields)) {
				continue;
			}
			if (false !== ($replaceKey = array_search($key, static::$_replacementFields))) {
				$key = $replaceKey;
			}
			$data[$key] = $value;
		}
		return $data;
	}

}
