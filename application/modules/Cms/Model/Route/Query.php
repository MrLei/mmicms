<?php

/**
 * @method Cms\Model\Route\Query limit() limit($limit = null)
 * @method Cms\Model\Route\Query offset() offset($offset = null)
 * @method Cms\Model\Route\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Route\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Route\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Route\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Route\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Route\Query resetOrder() resetOrder()
 * @method Cms\Model\Route\Query resetWhere() resetWhere()
 * @method Cms\Model\Route\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Route\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Route\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Route\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Route\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Route\Record[] find() find()
 * @method Cms\Model\Route\Record findFirst() findFirst()
 */

namespace Cms\Model\Route;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Route\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function wherePattern() {
		return $this->where('pattern');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldPattern() {
		return $this->andField('pattern');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldPattern() {
		return $this->orField('pattern');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscPattern() {
		return $this->orderAsc('pattern');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescPattern() {
		return $this->orderDesc('pattern');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function whereReplace() {
		return $this->where('replace');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldReplace() {
		return $this->andField('replace');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldReplace() {
		return $this->orField('replace');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscReplace() {
		return $this->orderAsc('replace');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescReplace() {
		return $this->orderDesc('replace');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function whereDefault() {
		return $this->where('default');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldDefault() {
		return $this->andField('default');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldDefault() {
		return $this->orField('default');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscDefault() {
		return $this->orderAsc('default');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescDefault() {
		return $this->orderDesc('default');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms\Model\Route\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}