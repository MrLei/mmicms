<?php

/**
 * @method \Cms\Model\Tag\Link\Query limit() limit($limit = null)
 * @method \Cms\Model\Tag\Link\Query offset() offset($offset = null)
 * @method \Cms\Model\Tag\Link\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query resetOrder() resetOrder()
 * @method \Cms\Model\Tag\Link\Query resetWhere() resetWhere()
 * @method \Cms\Model\Tag\Link\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Link\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Link\Record[] find() find()
 * @method \Cms\Model\Tag\Link\Record findFirst() findFirst()
 */

namespace Cms\Model\Tag\Link;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Tag\Link\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function whereCmsTagId() {
		return $this->where('cmsTagId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function andFieldCmsTagId() {
		return $this->andField('cmsTagId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orFieldCmsTagId() {
		return $this->orField('cmsTagId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderAscCmsTagId() {
		return $this->orderAsc('cmsTagId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderDescCmsTagId() {
		return $this->orderDesc('cmsTagId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\Tag\Link\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

}