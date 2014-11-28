<?php

/**
 * @method Cms_Model_Container_Query limit() limit($limit = null)
 * @method Cms_Model_Container_Query offset() offset($offset = null)
 * @method Cms_Model_Container_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query resetOrder() resetOrder()
 * @method Cms_Model_Container_Query resetWhere() resetWhere()
 */
class Cms_Model_Container_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function whereSerial() {
		return $this->where('serial');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldSerial() {
		return $this->andField('serial');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldSerial() {
		return $this->orField('serial');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscSerial() {
		return $this->orderAsc('serial');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescSerial() {
		return $this->orderDesc('serial');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function whereCms_container_template_id() {
		return $this->where('cms_container_template_id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldCms_container_template_id() {
		return $this->andField('cms_container_template_id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldCms_container_template_id() {
		return $this->orField('cms_container_template_id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscCms_container_template_id() {
		return $this->orderAsc('cms_container_template_id');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescCms_container_template_id() {
		return $this->orderDesc('cms_container_template_id');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}