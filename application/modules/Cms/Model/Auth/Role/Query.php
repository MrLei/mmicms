<?php

/**
 * @method Cms_Model_Auth_Role_Query limit() limit($limit = null)
 * @method Cms_Model_Auth_Role_Query offset() offset($offset = null)
 * @method Cms_Model_Auth_Role_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query resetOrder() resetOrder()
 * @method Cms_Model_Auth_Role_Query resetWhere() resetWhere()
 */
class Cms_Model_Auth_Role_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('Cms_Model_Auth_Role_Dao');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function whereCms_auth_id() {
		return $this->where('cms_auth_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function andFieldCms_auth_id() {
		return $this->andField('cms_auth_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orFieldCms_auth_id() {
		return $this->orField('cms_auth_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderAscCms_auth_id() {
		return $this->orderAsc('cms_auth_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderDescCms_auth_id() {
		return $this->orderDesc('cms_auth_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function whereCms_role_id() {
		return $this->where('cms_role_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function andFieldCms_role_id() {
		return $this->andField('cms_role_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orFieldCms_role_id() {
		return $this->orField('cms_role_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderAscCms_role_id() {
		return $this->orderAsc('cms_role_id');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderDescCms_role_id() {
		return $this->orderDesc('cms_role_id');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Auth_Role_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Auth_Role_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}