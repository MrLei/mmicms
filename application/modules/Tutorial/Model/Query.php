<?php

namespace Tutorial\Model;

/**
 * @method \Tutorial\Model\Query limit() limit($limit = null)
 * @method \Tutorial\Model\Query offset() offset($offset = null)
 * @method \Tutorial\Model\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Tutorial\Model\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Tutorial\Model\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Tutorial\Model\Query resetOrder() resetOrder()
 * @method \Tutorial\Model\Query resetWhere() resetWhere()
 * @method \Tutorial\Model\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Field where() where($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Tutorial\Model\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Tutorial\Model\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Tutorial\Model\Record[] find() find()
 * @method \Tutorial\Model\Record findFirst() findFirst()
 * @method \Tutorial\Model\Record findPk() findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Tutorial\Model\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return \Tutorial\Model\Query\Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

}
