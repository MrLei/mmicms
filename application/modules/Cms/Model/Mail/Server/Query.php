<?php

/**
 * @method Cms_Model_Mail_Server_Query limit() limit($limit = null)
 * @method Cms_Model_Mail_Server_Query offset() offset($offset = null)
 * @method Cms_Model_Mail_Server_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Server_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Server_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Server_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Server_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Server_Query resetOrder() resetOrder()
 * @method Cms_Model_Mail_Server_Query resetWhere() resetWhere()
 * @method Cms_Model_Mail_Server_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Server_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Server_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Server_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Server_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Server_Record[] find() find()
 * @method Cms_Model_Mail_Server_Record findFirst() findFirst()
 */
class Cms_Model_Mail_Server_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Mail_Server_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereAddress() {
		return $this->where('address');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldAddress() {
		return $this->andField('address');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldAddress() {
		return $this->orField('address');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscAddress() {
		return $this->orderAsc('address');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescAddress() {
		return $this->orderDesc('address');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function wherePort() {
		return $this->where('port');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldPort() {
		return $this->andField('port');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldPort() {
		return $this->orField('port');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscPort() {
		return $this->orderAsc('port');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescPort() {
		return $this->orderDesc('port');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereUsername() {
		return $this->where('username');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldUsername() {
		return $this->andField('username');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldUsername() {
		return $this->orField('username');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscUsername() {
		return $this->orderAsc('username');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescUsername() {
		return $this->orderDesc('username');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function wherePassword() {
		return $this->where('password');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldPassword() {
		return $this->andField('password');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldPassword() {
		return $this->orField('password');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscPassword() {
		return $this->orderAsc('password');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescPassword() {
		return $this->orderDesc('password');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereFrom() {
		return $this->where('from');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldFrom() {
		return $this->andField('from');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldFrom() {
		return $this->orField('from');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscFrom() {
		return $this->orderAsc('from');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescFrom() {
		return $this->orderDesc('from');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function whereSsl() {
		return $this->where('ssl');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function andFieldSsl() {
		return $this->andField('ssl');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orFieldSsl() {
		return $this->orField('ssl');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderAscSsl() {
		return $this->orderAsc('ssl');
	}

	/**
	 * @return Cms_Model_Mail_Server_Query_Field
	 */
	public function orderDescSsl() {
		return $this->orderDesc('ssl');
	}

}