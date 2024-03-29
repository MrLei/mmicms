<?php

/**
 * @method Cms_Model_Stat_Date_Query limit() limit($limit = null)
 * @method Cms_Model_Stat_Date_Query offset() offset($offset = null)
 * @method Cms_Model_Stat_Date_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Date_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Date_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Date_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Date_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Date_Query resetOrder() resetOrder()
 * @method Cms_Model_Stat_Date_Query resetWhere() resetWhere()
 * @method Cms_Model_Stat_Date_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Date_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Date_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Date_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Stat_Date_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Stat_Date_Record[] find() find()
 * @method Cms_Model_Stat_Date_Record findFirst() findFirst()
 */
class Cms_Model_Stat_Date_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Stat_Date_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereHour() {
		return $this->where('hour');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldHour() {
		return $this->andField('hour');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldHour() {
		return $this->orField('hour');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscHour() {
		return $this->orderAsc('hour');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescHour() {
		return $this->orderDesc('hour');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereDay() {
		return $this->where('day');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldDay() {
		return $this->andField('day');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldDay() {
		return $this->orField('day');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscDay() {
		return $this->orderAsc('day');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescDay() {
		return $this->orderDesc('day');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereMonth() {
		return $this->where('month');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldMonth() {
		return $this->andField('month');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldMonth() {
		return $this->orField('month');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscMonth() {
		return $this->orderAsc('month');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescMonth() {
		return $this->orderDesc('month');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereYear() {
		return $this->where('year');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldYear() {
		return $this->andField('year');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldYear() {
		return $this->orField('year');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscYear() {
		return $this->orderAsc('year');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescYear() {
		return $this->orderDesc('year');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function whereCount() {
		return $this->where('count');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function andFieldCount() {
		return $this->andField('count');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orFieldCount() {
		return $this->orField('count');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderAscCount() {
		return $this->orderAsc('count');
	}

	/**
	 * @return Cms_Model_Stat_Date_Query_Field
	 */
	public function orderDescCount() {
		return $this->orderDesc('count');
	}

}