<?php

/**
 * @method \Cms\Model\Tag\Query limit() limit($limit = null)
 * @method \Cms\Model\Tag\Query offset() offset($offset = null)
 * @method \Cms\Model\Tag\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query resetOrder() resetOrder()
 * @method \Cms\Model\Tag\Query resetWhere() resetWhere()
 * @method \Cms\Model\Tag\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Record[] find() find()
 * @method \Cms\Model\Tag\Record findFirst() findFirst()
 */

namespace Cms\Model\Tag;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Tag\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function whereTag() {
		return $this->where('tag');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function andFieldTag() {
		return $this->andField('tag');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orFieldTag() {
		return $this->orField('tag');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orderAscTag() {
		return $this->orderAsc('tag');
	}

	/**
	 * @return \Cms\Model\Tag\Query\Field
	 */
	public function orderDescTag() {
		return $this->orderDesc('tag');
	}

}