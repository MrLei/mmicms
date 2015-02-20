<?php

/**
 * @method Cms\Model\Widget\Text\Query limit() limit($limit = null)
 * @method Cms\Model\Widget\Text\Query offset() offset($offset = null)
 * @method Cms\Model\Widget\Text\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Widget\Text\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Widget\Text\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Widget\Text\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Widget\Text\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Widget\Text\Query resetOrder() resetOrder()
 * @method Cms\Model\Widget\Text\Query resetWhere() resetWhere()
 * @method Cms\Model\Widget\Text\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Widget\Text\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Widget\Text\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Widget\Text\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Widget\Text\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Widget\Text\Record[] find() find()
 * @method Cms\Model\Widget\Text\Record findFirst() findFirst()
 */

namespace Cms\Model\Widget\Text;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Widget\Text\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return Cms\Model\Widget\Text\Query\Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

}