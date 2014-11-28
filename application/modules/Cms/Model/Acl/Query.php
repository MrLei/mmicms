<?php

/**
 * @method Cms_Model_Acl_Query limit() limit($limit = null)
 * @method Cms_Model_Acl_Query offset() offset($offset = null)
 * @method Cms_Model_Acl_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query resetOrder() resetOrder()
 * @method Cms_Model_Acl_Query resetWhere() resetWhere()
 */
class Cms_Model_Acl_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereCms_role_id() {
		return $this->where('cms_role_id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldCms_role_id() {
		return $this->andField('cms_role_id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldCms_role_id() {
		return $this->orField('cms_role_id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscCms_role_id() {
		return $this->orderAsc('cms_role_id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescCms_role_id() {
		return $this->orderDesc('cms_role_id');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function whereAccess() {
		return $this->where('access');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldAccess() {
		return $this->andField('access');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldAccess() {
		return $this->orField('access');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscAccess() {
		return $this->orderAsc('access');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescAccess() {
		return $this->orderDesc('access');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Acl_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Acl_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}