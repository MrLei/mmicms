<?php

/**
 * @method \Cms\Model\Widget\Picture\Query limit() limit($limit = null)
 * @method \Cms\Model\Widget\Picture\Query offset() offset($offset = null)
 * @method \Cms\Model\Widget\Picture\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query resetOrder() resetOrder()
 * @method \Cms\Model\Widget\Picture\Query resetWhere() resetWhere()
 * @method \Cms\Model\Widget\Picture\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Picture\Record[] find() find()
 * @method \Cms\Model\Widget\Picture\Record findFirst() findFirst()
 */

namespace Cms\Model\Widget\Picture;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Widget\Picture\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Widget\Picture\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

}
