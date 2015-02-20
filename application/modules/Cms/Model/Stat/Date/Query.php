<?php

/**
 * @method \Cms\Model\Stat\Date\Query limit() limit($limit = null)
 * @method \Cms\Model\Stat\Date\Query offset() offset($offset = null)
 * @method \Cms\Model\Stat\Date\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query resetOrder() resetOrder()
 * @method \Cms\Model\Stat\Date\Query resetWhere() resetWhere()
 * @method \Cms\Model\Stat\Date\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Date\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Date\Record[] find() find()
 * @method \Cms\Model\Stat\Date\Record findFirst() findFirst()
 */

namespace Cms\Model\Stat\Date;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Stat\Date\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereHour() {
		return $this->where('hour');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldHour() {
		return $this->andField('hour');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldHour() {
		return $this->orField('hour');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscHour() {
		return $this->orderAsc('hour');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescHour() {
		return $this->orderDesc('hour');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereDay() {
		return $this->where('day');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldDay() {
		return $this->andField('day');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldDay() {
		return $this->orField('day');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscDay() {
		return $this->orderAsc('day');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescDay() {
		return $this->orderDesc('day');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereMonth() {
		return $this->where('month');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldMonth() {
		return $this->andField('month');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldMonth() {
		return $this->orField('month');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscMonth() {
		return $this->orderAsc('month');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescMonth() {
		return $this->orderDesc('month');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereYear() {
		return $this->where('year');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldYear() {
		return $this->andField('year');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldYear() {
		return $this->orField('year');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscYear() {
		return $this->orderAsc('year');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescYear() {
		return $this->orderDesc('year');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function whereCount() {
		return $this->where('count');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function andFieldCount() {
		return $this->andField('count');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orFieldCount() {
		return $this->orField('count');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderAscCount() {
		return $this->orderAsc('count');
	}

	/**
	 * @return \Cms\Model\Stat\Date\Query\Field
	 */
	public function orderDescCount() {
		return $this->orderDesc('count');
	}

}