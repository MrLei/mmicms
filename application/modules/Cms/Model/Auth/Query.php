<?php

/**
 * @method Cms_Model_Auth_Query limit() limit($limit = null)
 * @method Cms_Model_Auth_Query offset() offset($offset = null)
 * @method Cms_Model_Auth_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Query resetOrder() resetOrder()
 * @method Cms_Model_Auth_Query resetWhere() resetWhere()
 */
class Cms_Model_Auth_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('Cms_Model_Auth_Dao');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereUsername() {
		return $this->where('username');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldUsername() {
		return $this->andField('username');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldUsername() {
		return $this->orField('username');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscUsername() {
		return $this->orderAsc('username');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescUsername() {
		return $this->orderDesc('username');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereEmail() {
		return $this->where('email');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldEmail() {
		return $this->andField('email');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldEmail() {
		return $this->orField('email');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscEmail() {
		return $this->orderAsc('email');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescEmail() {
		return $this->orderDesc('email');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function wherePassword() {
		return $this->where('password');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldPassword() {
		return $this->andField('password');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldPassword() {
		return $this->orField('password');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscPassword() {
		return $this->orderAsc('password');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescPassword() {
		return $this->orderDesc('password');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLastIp() {
		return $this->where('lastIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLastIp() {
		return $this->andField('lastIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLastIp() {
		return $this->orField('lastIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLastIp() {
		return $this->orderAsc('lastIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLastIp() {
		return $this->orderDesc('lastIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLastLog() {
		return $this->where('lastLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLastLog() {
		return $this->andField('lastLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLastLog() {
		return $this->orField('lastLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLastLog() {
		return $this->orderAsc('lastLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLastLog() {
		return $this->orderDesc('lastLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLastFailIp() {
		return $this->where('lastFailIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLastFailIp() {
		return $this->andField('lastFailIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLastFailIp() {
		return $this->orField('lastFailIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLastFailIp() {
		return $this->orderAsc('lastFailIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLastFailIp() {
		return $this->orderDesc('lastFailIp');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLastFailLog() {
		return $this->where('lastFailLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLastFailLog() {
		return $this->andField('lastFailLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLastFailLog() {
		return $this->orField('lastFailLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLastFailLog() {
		return $this->orderAsc('lastFailLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLastFailLog() {
		return $this->orderDesc('lastFailLog');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereFailLogCount() {
		return $this->where('failLogCount');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldFailLogCount() {
		return $this->andField('failLogCount');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldFailLogCount() {
		return $this->orField('failLogCount');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscFailLogCount() {
		return $this->orderAsc('failLogCount');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescFailLogCount() {
		return $this->orderDesc('failLogCount');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereLogged() {
		return $this->where('logged');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldLogged() {
		return $this->andField('logged');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldLogged() {
		return $this->orField('logged');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscLogged() {
		return $this->orderAsc('logged');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescLogged() {
		return $this->orderDesc('logged');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Auth_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Auth_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Auth_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}