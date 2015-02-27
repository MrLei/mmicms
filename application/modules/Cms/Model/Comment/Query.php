<?php

namespace Cms\Model\Comment;

/**
 * @method \Cms\Model\Comment\Query limit() limit($limit = null)
 * @method \Cms\Model\Comment\Query offset() offset($offset = null)
 * @method \Cms\Model\Comment\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Comment\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Comment\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Comment\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Comment\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Comment\Query resetOrder() resetOrder()
 * @method \Cms\Model\Comment\Query resetWhere() resetWhere()
 * @method \Cms\Model\Comment\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Comment\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Comment\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Comment\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Comment\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Comment\Record[] find() find()
 * @method \Cms\Model\Comment\Record findFirst() findFirst()
 * @method \Cms\Model\Comment\Record findPk() findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Comment\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereParentId() {
		return $this->where('parentId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldParentId() {
		return $this->andField('parentId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldParentId() {
		return $this->orField('parentId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscParentId() {
		return $this->orderAsc('parentId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescParentId() {
		return $this->orderDesc('parentId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereSignature() {
		return $this->where('signature');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldSignature() {
		return $this->andField('signature');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldSignature() {
		return $this->orField('signature');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscSignature() {
		return $this->orderAsc('signature');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescSignature() {
		return $this->orderDesc('signature');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereStars() {
		return $this->where('stars');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldStars() {
		return $this->andField('stars');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldStars() {
		return $this->orField('stars');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscStars() {
		return $this->orderAsc('stars');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescStars() {
		return $this->orderDesc('stars');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\Comment\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

}
