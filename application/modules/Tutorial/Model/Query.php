<?php

/**
 * @method Tutorial_Model_Query limit() limit($limit = null)
 * @method Tutorial_Model_Query offset() offset($offset = null)
 * @method Tutorial_Model_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Tutorial_Model_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Tutorial_Model_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Tutorial_Model_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Tutorial_Model_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Tutorial_Model_Query resetOrder() resetOrder()
 * @method Tutorial_Model_Query resetWhere() resetWhere()
 * @method Tutorial_Model_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Tutorial_Model_Query_Field where() where($fieldName, $tableName = null)
 * @method Tutorial_Model_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Tutorial_Model_Query_Join join() join($tableName, $targetTableName = null)
 * @method Tutorial_Model_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Tutorial_Model_Record[] find() find()
 * @method Tutorial_Model_Record findFirst() findFirst()
 */
class Tutorial_Model_Query extends Mmi_Dao_Query {

	/**
	 * @return Tutorial_Model_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return Tutorial_Model_Query_Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

}