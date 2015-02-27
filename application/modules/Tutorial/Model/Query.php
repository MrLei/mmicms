<?php

namespace Tutorial\Model;

/**
 * @method Query limit() limit($limit = null)
 * @method Query offset() offset($offset = null)
 * @method Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Query resetOrder() resetOrder()
 * @method Query resetWhere() resetWhere()
 * @method \Tutorial\Model\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Field where() where($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Tutorial\Model\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Tutorial\Model\Record[] find() find()
 * @method \Tutorial\Model\Record findFirst() findFirst()
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return Tutorial\Model_Query\Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

}
