<?php

/**
 * @method Stat_Model_Query limit() limit($limit = null)
 * @method Stat_Model_Query offset() offset($offset = null)
 * @method Stat_Model_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Stat_Model_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Stat_Model_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Query andField() andField($fieldName, $tableName = null)
 * @method Stat_Model_Query where() where($fieldName, $tableName = null)
 * @method Stat_Model_Query orField() orField($fieldName, $tableName = null)
 * @method Stat_Model_Query resetOrder() resetOrder()
 * @method Stat_Model_Query resetWhere() resetWhere()
 */
class Stat_Model_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('Stat_Model_Dao');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function whereDateTime() {
		return $this->where('dateTime');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function andFieldDateTime() {
		return $this->andField('dateTime');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orFieldDateTime() {
		return $this->orField('dateTime');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderAscDateTime() {
		return $this->orderAsc('dateTime');
	}

	/**
	 * @return Stat_Model_Query_Field
	 */
	public function orderDescDateTime() {
		return $this->orderDesc('dateTime');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Stat_Model_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Stat_Model_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}