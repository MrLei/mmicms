<?php

/**
 * @method \Cms\Model\Stat\Query limit() limit($limit = null)
 * @method \Cms\Model\Stat\Query offset() offset($offset = null)
 * @method \Cms\Model\Stat\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query resetOrder() resetOrder()
 * @method \Cms\Model\Stat\Query resetWhere() resetWhere()
 * @method \Cms\Model\Stat\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Record[] find() find()
 * @method \Cms\Model\Stat\Record findFirst() findFirst()
 */

namespace Cms\Model\Stat;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Stat\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function whereDateTime() {
		return $this->where('dateTime');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function andFieldDateTime() {
		return $this->andField('dateTime');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orFieldDateTime() {
		return $this->orField('dateTime');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderAscDateTime() {
		return $this->orderAsc('dateTime');
	}

	/**
	 * @return \Cms\Model\Stat\Query\Field
	 */
	public function orderDescDateTime() {
		return $this->orderDesc('dateTime');
	}

}