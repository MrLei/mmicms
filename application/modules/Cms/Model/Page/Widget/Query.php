<?php

/**
 * @method \Cms\Model\Page\Widget\Query limit() limit($limit = null)
 * @method \Cms\Model\Page\Widget\Query offset() offset($offset = null)
 * @method \Cms\Model\Page\Widget\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query resetOrder() resetOrder()
 * @method \Cms\Model\Page\Widget\Query resetWhere() resetWhere()
 * @method \Cms\Model\Page\Widget\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Widget\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Widget\Record[] find() find()
 * @method \Cms\Model\Page\Widget\Record findFirst() findFirst()
 */

namespace Cms\Model\Page\Widget;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Page\Widget\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereParams() {
		return $this->where('params');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldParams() {
		return $this->andField('params');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldParams() {
		return $this->orField('params');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscParams() {
		return $this->orderAsc('params');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescParams() {
		return $this->orderDesc('params');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Page\Widget\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}