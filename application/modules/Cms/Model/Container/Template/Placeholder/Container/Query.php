<?php

/**
 * @method Cms_Model_Container_Template_Placeholder_Container_Query limit() limit($limit = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query offset() offset($offset = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Container_Template_Placeholder_Container_Query resetOrder() resetOrder()
 * @method Cms_Model_Container_Template_Placeholder_Container_Query resetWhere() resetWhere()
 * @method Mmi_Dao_Record_Collection find() find()
 * @method Cms_Model_Container_Template_Placeholder_Container_Record findFirst() findFirst()
 */
class Cms_Model_Container_Template_Placeholder_Container_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereCmsContainerId() {
		return $this->where('cmsContainerId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldCmsContainerId() {
		return $this->andField('cmsContainerId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldCmsContainerId() {
		return $this->orField('cmsContainerId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscCmsContainerId() {
		return $this->orderAsc('cmsContainerId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescCmsContainerId() {
		return $this->orderDesc('cmsContainerId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereCmsContainerTemplatePlaceholderId() {
		return $this->where('cmsContainerTemplatePlaceholderId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldCmsContainerTemplatePlaceholderId() {
		return $this->andField('cmsContainerTemplatePlaceholderId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldCmsContainerTemplatePlaceholderId() {
		return $this->orField('cmsContainerTemplatePlaceholderId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscCmsContainerTemplatePlaceholderId() {
		return $this->orderAsc('cmsContainerTemplatePlaceholderId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescCmsContainerTemplatePlaceholderId() {
		return $this->orderDesc('cmsContainerTemplatePlaceholderId');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereParams() {
		return $this->where('params');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldParams() {
		return $this->andField('params');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldParams() {
		return $this->orField('params');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscParams() {
		return $this->orderAsc('params');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescParams() {
		return $this->orderDesc('params');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereMarginTop() {
		return $this->where('marginTop');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldMarginTop() {
		return $this->andField('marginTop');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldMarginTop() {
		return $this->orField('marginTop');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscMarginTop() {
		return $this->orderAsc('marginTop');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescMarginTop() {
		return $this->orderDesc('marginTop');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereMarginRight() {
		return $this->where('marginRight');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldMarginRight() {
		return $this->andField('marginRight');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldMarginRight() {
		return $this->orField('marginRight');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscMarginRight() {
		return $this->orderAsc('marginRight');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescMarginRight() {
		return $this->orderDesc('marginRight');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereMarginBottom() {
		return $this->where('marginBottom');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldMarginBottom() {
		return $this->andField('marginBottom');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldMarginBottom() {
		return $this->orField('marginBottom');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscMarginBottom() {
		return $this->orderAsc('marginBottom');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescMarginBottom() {
		return $this->orderDesc('marginBottom');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function whereMarginLeft() {
		return $this->where('marginLeft');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function andFieldMarginLeft() {
		return $this->andField('marginLeft');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orFieldMarginLeft() {
		return $this->orField('marginLeft');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderAscMarginLeft() {
		return $this->orderAsc('marginLeft');
	}

	/**
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Field
	 */
	public function orderDescMarginLeft() {
		return $this->orderDesc('marginLeft');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Container_Template_Placeholder_Container_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}