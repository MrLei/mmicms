<?php

/**
 * @method Cms_Model_Container_Query limit() limit($limit = null)
 * @method Cms_Model_Container_Query offset() offset($offset = null)
 * @method Cms_Model_Container_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Query resetOrder() resetOrder()
 * @method Cms_Model_Container_Query resetWhere() resetWhere()
 * @method Mmi_Dao_Record_Collection find() find()
 * @method Cms_Model_Container_Record findFirst() findFirst()
 */
class Cms_Model_Container_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Container_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

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
	public function whereCmsContainerTemplateId() {
		return $this->where('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function andFieldCmsContainerTemplateId() {
		return $this->andField('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orFieldCmsContainerTemplateId() {
		return $this->orField('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderAscCmsContainerTemplateId() {
		return $this->orderAsc('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Query_Field
	 */
	public function orderDescCmsContainerTemplateId() {
		return $this->orderDesc('cmsContainerTemplateId');
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