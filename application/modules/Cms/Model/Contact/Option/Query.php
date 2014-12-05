<?php

/**
 * @method Cms_Model_Contact_Option_Query limit() limit($limit = null)
 * @method Cms_Model_Contact_Option_Query offset() offset($offset = null)
 * @method Cms_Model_Contact_Option_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Option_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Option_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Option_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Option_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Option_Query resetOrder() resetOrder()
 * @method Cms_Model_Contact_Option_Query resetWhere() resetWhere()
 * @method Cms_Model_Contact_Option_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Option_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Option_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Option_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Contact_Option_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Contact_Option_Record[] find() find()
 * @method Cms_Model_Contact_Option_Record findFirst() findFirst()
 */
class Cms_Model_Contact_Option_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Contact_Option_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function whereSendTo() {
		return $this->where('sendTo');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function andFieldSendTo() {
		return $this->andField('sendTo');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orFieldSendTo() {
		return $this->orField('sendTo');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderAscSendTo() {
		return $this->orderAsc('sendTo');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderDescSendTo() {
		return $this->orderDesc('sendTo');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Contact_Option_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

}