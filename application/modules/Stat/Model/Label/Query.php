<?php

/**
 * @method Stat_Model_Label_Query limit() limit($limit = null)
 * @method Stat_Model_Label_Query offset() offset($offset = null)
 * @method Stat_Model_Label_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Stat_Model_Label_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Stat_Model_Label_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Label_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Label_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Stat_Model_Label_Query resetOrder() resetOrder()
 * @method Stat_Model_Label_Query resetWhere() resetWhere()
 * @method Stat_Model_Label_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Stat_Model_Label_Query_Field where() where($fieldName, $tableName = null)
 * @method Stat_Model_Label_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Stat_Model_Label_Query_Join join() join($tableName, $targetTableName = null)
 * @method Stat_Model_Label_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Stat_Model_Label_Record[] find() find()
 * @method Stat_Model_Label_Record findFirst() findFirst()
 */
class Stat_Model_Label_Query extends Mmi_Dao_Query {

	/**
	 * @return Stat_Model_Label_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function whereLabel() {
		return $this->where('label');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function andFieldLabel() {
		return $this->andField('label');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orFieldLabel() {
		return $this->orField('label');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderAscLabel() {
		return $this->orderAsc('label');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderDescLabel() {
		return $this->orderDesc('label');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return Stat_Model_Label_Query_Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

}