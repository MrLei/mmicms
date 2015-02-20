<?php

/**
 * @method Cms\Model\Role\Query limit() limit($limit = null)
 * @method Cms\Model\Role\Query offset() offset($offset = null)
 * @method Cms\Model\Role\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Role\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Role\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Role\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Role\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Role\Query resetOrder() resetOrder()
 * @method Cms\Model\Role\Query resetWhere() resetWhere()
 * @method Cms\Model\Role\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Role\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Role\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Role\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Role\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Role\Record[] find() find()
 * @method Cms\Model\Role\Record findFirst() findFirst()
 */

namespace Cms\Model\Role;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Role\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms\Model\Role\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

}