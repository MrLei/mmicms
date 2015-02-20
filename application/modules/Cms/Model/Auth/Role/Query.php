<?php

/**
 * @method \Cms\Model\Auth\Role\Query limit() limit($limit = null)
 * @method \Cms\Model\Auth\Role\Query offset() offset($offset = null)
 * @method \Cms\Model\Auth\Role\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query resetOrder() resetOrder()
 * @method \Cms\Model\Auth\Role\Query resetWhere() resetWhere()
 * @method \Cms\Model\Auth\Role\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Role\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Role\Record[] find() find()
 * @method \Cms\Model\Auth\Role\Record findFirst() findFirst()
 */

namespace Cms\Model\Auth\Role;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Auth\Role\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function whereCmsRoleId() {
		return $this->where('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function andFieldCmsRoleId() {
		return $this->andField('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orFieldCmsRoleId() {
		return $this->orField('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderAscCmsRoleId() {
		return $this->orderAsc('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Auth\Role\Query\Field
	 */
	public function orderDescCmsRoleId() {
		return $this->orderDesc('cmsRoleId');
	}

}