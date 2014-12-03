<?php

/**
 * @method Cms_Model_Container_Template_Placeholder_Query limit() limit($limit = null)
 * @method Cms_Model_Container_Template_Placeholder_Query offset() offset($offset = null)
 * @method Cms_Model_Container_Template_Placeholder_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Query resetOrder() resetOrder()
 * @method Cms_Model_Container_Template_Placeholder_Query resetWhere() resetWhere()
 * @method Mmi_Dao_Record_Collection find() find()
 * @method Cms_Model_Container_Template_Placeholder_Record findFirst() findFirst()
 */
class Cms_Model_Container_Template_Placeholder_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function whereCmsContainerTemplateId() {
		return $this->where('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function andFieldCmsContainerTemplateId() {
		return $this->andField('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orFieldCmsContainerTemplateId() {
		return $this->orField('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderAscCmsContainerTemplateId() {
		return $this->orderAsc('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderDescCmsContainerTemplateId() {
		return $this->orderDesc('cmsContainerTemplateId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function wherePlaceholder() {
		return $this->where('placeholder');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function andFieldPlaceholder() {
		return $this->andField('placeholder');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orFieldPlaceholder() {
		return $this->orField('placeholder');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderAscPlaceholder() {
		return $this->orderAsc('placeholder');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderDescPlaceholder() {
		return $this->orderDesc('placeholder');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Placeholder_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Placeholder_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}