<?php

/**
 * @method Cms_Model_Page_Widget_Query limit() limit($limit = null)
 * @method Cms_Model_Page_Widget_Query offset() offset($offset = null)
 * @method Cms_Model_Page_Widget_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Page_Widget_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Page_Widget_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Widget_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Widget_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Widget_Query resetOrder() resetOrder()
 * @method Cms_Model_Page_Widget_Query resetWhere() resetWhere()
 * @method Cms_Model_Page_Widget_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Page_Widget_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Page_Widget_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Page_Widget_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Page_Widget_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Page_Widget_Record[] find() find()
 * @method Cms_Model_Page_Widget_Record findFirst() findFirst()
 */
class Cms_Model_Page_Widget_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Page_Widget_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereParams() {
		return $this->where('params');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldParams() {
		return $this->andField('params');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldParams() {
		return $this->orField('params');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscParams() {
		return $this->orderAsc('params');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescParams() {
		return $this->orderDesc('params');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Page_Widget_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

}