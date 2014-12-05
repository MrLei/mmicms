<?php

/**
 * @method Cms_Model_Auth_Role_Query limit() limit($limit = null)
 * @method Cms_Model_Auth_Role_Query offset() offset($offset = null)
 * @method Cms_Model_Auth_Role_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Auth_Role_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Auth_Role_Query resetOrder() resetOrder()
 * @method Cms_Model_Auth_Role_Query resetWhere() resetWhere()
 * @method Cms_Model_Auth_Role_Record[] find() find()
 * @method Cms_Model_Auth_Role_Record findFirst() findFirst()
 */
class Cms_Model_Auth_Role_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Auth_Role_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
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
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function whereCmsRoleId() {
		return $this->where('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function andFieldCmsRoleId() {
		return $this->andField('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orFieldCmsRoleId() {
		return $this->orField('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderAscCmsRoleId() {
		return $this->orderAsc('cmsRoleId');
	}

	/**
	 * @return Cms_Model_Auth_Role_Query_Field
	 */
	public function orderDescCmsRoleId() {
		return $this->orderDesc('cmsRoleId');
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