<?php

/**
 * @method Cms_Model_Role_Query limit() limit($limit = null)
 * @method Cms_Model_Role_Query offset() offset($offset = null)
 * @method Cms_Model_Role_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Role_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Role_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Role_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Role_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Role_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Role_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Role_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Role_Query resetOrder() resetOrder()
 * @method Cms_Model_Role_Query resetWhere() resetWhere()
 */
class Cms_Model_Role_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Role_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Role_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Role_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}