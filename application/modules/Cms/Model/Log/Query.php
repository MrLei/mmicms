<?php

/**
 * @method \Cms\Model\Log\Query limit() limit($limit = null)
 * @method \Cms\Model\Log\Query offset() offset($offset = null)
 * @method \Cms\Model\Log\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Log\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Log\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Log\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Log\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Log\Query resetOrder() resetOrder()
 * @method \Cms\Model\Log\Query resetWhere() resetWhere()
 * @method \Cms\Model\Log\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Log\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Log\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Log\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Log\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Log\Record[] find() find()
 * @method \Cms\Model\Log\Record findFirst() findFirst()
 */

namespace Cms\Model\Log;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Log\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereUrl() {
		return $this->where('url');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldUrl() {
		return $this->andField('url');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldUrl() {
		return $this->orField('url');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscUrl() {
		return $this->orderAsc('url');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescUrl() {
		return $this->orderDesc('url');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereBrowser() {
		return $this->where('browser');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldBrowser() {
		return $this->andField('browser');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldBrowser() {
		return $this->orField('browser');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscBrowser() {
		return $this->orderAsc('browser');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescBrowser() {
		return $this->orderDesc('browser');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereOperation() {
		return $this->where('operation');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldOperation() {
		return $this->andField('operation');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldOperation() {
		return $this->orField('operation');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscOperation() {
		return $this->orderAsc('operation');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescOperation() {
		return $this->orderDesc('operation');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereSuccess() {
		return $this->where('success');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldSuccess() {
		return $this->andField('success');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldSuccess() {
		return $this->orField('success');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscSuccess() {
		return $this->orderAsc('success');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescSuccess() {
		return $this->orderDesc('success');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function whereDateTime() {
		return $this->where('dateTime');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function andFieldDateTime() {
		return $this->andField('dateTime');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orFieldDateTime() {
		return $this->orField('dateTime');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderAscDateTime() {
		return $this->orderAsc('dateTime');
	}

	/**
	 * @return \Cms\Model\Log\Query\Field
	 */
	public function orderDescDateTime() {
		return $this->orderDesc('dateTime');
	}

}
