<?php

/**
 * @method \Cms\Model\Acl\Query limit() limit($limit = null)
 * @method \Cms\Model\Acl\Query offset() offset($offset = null)
 * @method \Cms\Model\Acl\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query resetOrder() resetOrder()
 * @method \Cms\Model\Acl\Query resetWhere() resetWhere()
 * @method \Cms\Model\Acl\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Acl\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Acl\Record[] find() find()
 * @method \Cms\Model\Acl\Record findFirst() findFirst()
 */

namespace Cms\Model\Acl;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Acl\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereCmsRoleId() {
		return $this->where('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldCmsRoleId() {
		return $this->andField('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldCmsRoleId() {
		return $this->orField('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscCmsRoleId() {
		return $this->orderAsc('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescCmsRoleId() {
		return $this->orderDesc('cmsRoleId');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function whereAccess() {
		return $this->where('access');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function andFieldAccess() {
		return $this->andField('access');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orFieldAccess() {
		return $this->orField('access');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderAscAccess() {
		return $this->orderAsc('access');
	}

	/**
	 * @return \Cms\Model\Acl\Query\Field
	 */
	public function orderDescAccess() {
		return $this->orderDesc('access');
	}

}