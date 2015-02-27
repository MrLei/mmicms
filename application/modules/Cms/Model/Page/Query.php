<?php

namespace Cms\Model\Page;

/**
 * @method \Cms\Model\Page\Query limit() limit($limit = null)
 * @method \Cms\Model\Page\Query offset() offset($offset = null)
 * @method \Cms\Model\Page\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query resetOrder() resetOrder()
 * @method \Cms\Model\Page\Query resetWhere() resetWhere()
 * @method \Cms\Model\Page\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Record[] find() find()
 * @method \Cms\Model\Page\Record findFirst() findFirst()
 * @method \Cms\Model\Page\Record findPk() findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Page\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereCmsNavigationId() {
		return $this->where('cmsNavigationId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldCmsNavigationId() {
		return $this->andField('cmsNavigationId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldCmsNavigationId() {
		return $this->orField('cmsNavigationId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscCmsNavigationId() {
		return $this->orderAsc('cmsNavigationId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescCmsNavigationId() {
		return $this->orderDesc('cmsNavigationId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereCmsRouteId() {
		return $this->where('cmsRouteId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldCmsRouteId() {
		return $this->andField('cmsRouteId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldCmsRouteId() {
		return $this->orField('cmsRouteId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscCmsRouteId() {
		return $this->orderAsc('cmsRouteId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescCmsRouteId() {
		return $this->orderDesc('cmsRouteId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Page\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

}
