<?php

/**
 * @method Cms_Model_Route_Query limit() limit($limit = null)
 * @method Cms_Model_Route_Query offset() offset($offset = null)
 * @method Cms_Model_Route_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Route_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Route_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Route_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Route_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Route_Query resetOrder() resetOrder()
 * @method Cms_Model_Route_Query resetWhere() resetWhere()
 * @method Cms_Model_Route_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Route_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Route_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Route_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Route_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Route_Record[] find() find()
 * @method Cms_Model_Route_Record findFirst() findFirst()
 */
class Cms_Model_Route_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Route_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function wherePattern() {
		return $this->where('pattern');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldPattern() {
		return $this->andField('pattern');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldPattern() {
		return $this->orField('pattern');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscPattern() {
		return $this->orderAsc('pattern');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescPattern() {
		return $this->orderDesc('pattern');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function whereReplace() {
		return $this->where('replace');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldReplace() {
		return $this->andField('replace');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldReplace() {
		return $this->orField('replace');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscReplace() {
		return $this->orderAsc('replace');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescReplace() {
		return $this->orderDesc('replace');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function whereDefault() {
		return $this->where('default');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldDefault() {
		return $this->andField('default');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldDefault() {
		return $this->orField('default');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscDefault() {
		return $this->orderAsc('default');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescDefault() {
		return $this->orderDesc('default');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Route_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}