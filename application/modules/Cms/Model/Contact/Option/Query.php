<?php

/**
 * @method \Cms\Model\Contact\Option\Query limit() limit($limit = null)
 * @method \Cms\Model\Contact\Option\Query offset() offset($offset = null)
 * @method \Cms\Model\Contact\Option\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query resetOrder() resetOrder()
 * @method \Cms\Model\Contact\Option\Query resetWhere() resetWhere()
 * @method \Cms\Model\Contact\Option\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Option\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Option\Record[] find() find()
 * @method \Cms\Model\Contact\Option\Record findFirst() findFirst()
 */

namespace Cms\Model\Contact\Option;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Contact\Option\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function whereSendTo() {
		return $this->where('sendTo');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function andFieldSendTo() {
		return $this->andField('sendTo');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orFieldSendTo() {
		return $this->orField('sendTo');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderAscSendTo() {
		return $this->orderAsc('sendTo');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderDescSendTo() {
		return $this->orderDesc('sendTo');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\Contact\Option\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

}