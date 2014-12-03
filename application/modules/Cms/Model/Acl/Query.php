<?php

/**
 * @method Cms_Model_Acl_Query limit() limit($limit = null)
 * @method Cms_Model_Acl_Query offset() offset($offset = null)
 * @method Cms_Model_Acl_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Acl_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Acl_Query resetOrder() resetOrder()
 * @method Cms_Model_Acl_Query resetWhere() resetWhere()
 * @method Mmi_Dao_Record_Collection find() find()
 * @method Cms_Model_Acl_Record findFirst() findFirst()
 */
class Cms_Model_Acl_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Acl_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

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
	public function whereCmsRoleId() {
		return $this->where('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function andFieldCmsRoleId() {
		return $this->andField('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orFieldCmsRoleId() {
		return $this->orField('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderAscCmsRoleId() {
		return $this->orderAsc('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Acl_Query_Field
	 */
	public function orderDescCmsRoleId() {
		return $this->orderDesc('cmsRoleId');
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