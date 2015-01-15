<?php

/**
 * @method Cms_Model_Page_Query limit() limit($limit = null)
 * @method Cms_Model_Page_Query offset() offset($offset = null)
 * @method Cms_Model_Page_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Page_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Page_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Page_Query resetOrder() resetOrder()
 * @method Cms_Model_Page_Query resetWhere() resetWhere()
 * @method Cms_Model_Page_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Page_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Page_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Page_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Page_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Page_Record[] find() find()
 * @method Cms_Model_Page_Record findFirst() findFirst()
 */
class Cms_Model_Page_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Page_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereCmsNavigationId() {
		return $this->where('cmsNavigationId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldCmsNavigationId() {
		return $this->andField('cmsNavigationId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldCmsNavigationId() {
		return $this->orField('cmsNavigationId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscCmsNavigationId() {
		return $this->orderAsc('cmsNavigationId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescCmsNavigationId() {
		return $this->orderDesc('cmsNavigationId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereCmsRouteId() {
		return $this->where('cmsRouteId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldCmsRouteId() {
		return $this->andField('cmsRouteId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldCmsRouteId() {
		return $this->orField('cmsRouteId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscCmsRouteId() {
		return $this->orderAsc('cmsRouteId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescCmsRouteId() {
		return $this->orderDesc('cmsRouteId');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_Page_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

}