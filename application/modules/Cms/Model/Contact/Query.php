<?php

/**
 * @method \Cms\Model\Contact\Query limit() limit($limit = null)
 * @method \Cms\Model\Contact\Query offset() offset($offset = null)
 * @method \Cms\Model\Contact\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Query resetOrder() resetOrder()
 * @method \Cms\Model\Contact\Query resetWhere() resetWhere()
 * @method \Cms\Model\Contact\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Record[] find() find()
 * @method \Cms\Model\Contact\Record findFirst() findFirst()
 */

namespace Cms\Model\Contact;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Contact\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereCmsContactOptionId() {
		return $this->where('cmsContactOptionId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldCmsContactOptionId() {
		return $this->andField('cmsContactOptionId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldCmsContactOptionId() {
		return $this->orField('cmsContactOptionId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscCmsContactOptionId() {
		return $this->orderAsc('cmsContactOptionId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescCmsContactOptionId() {
		return $this->orderDesc('cmsContactOptionId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereReply() {
		return $this->where('reply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldReply() {
		return $this->andField('reply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldReply() {
		return $this->orField('reply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscReply() {
		return $this->orderAsc('reply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescReply() {
		return $this->orderDesc('reply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereCmsAuthIdReply() {
		return $this->where('cmsAuthIdReply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldCmsAuthIdReply() {
		return $this->andField('cmsAuthIdReply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldCmsAuthIdReply() {
		return $this->orField('cmsAuthIdReply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscCmsAuthIdReply() {
		return $this->orderAsc('cmsAuthIdReply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescCmsAuthIdReply() {
		return $this->orderDesc('cmsAuthIdReply');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function wherePhone() {
		return $this->where('phone');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldPhone() {
		return $this->andField('phone');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldPhone() {
		return $this->orField('phone');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscPhone() {
		return $this->orderAsc('phone');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescPhone() {
		return $this->orderDesc('phone');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereEmail() {
		return $this->where('email');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldEmail() {
		return $this->andField('email');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldEmail() {
		return $this->orField('email');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscEmail() {
		return $this->orderAsc('email');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescEmail() {
		return $this->orderDesc('email');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Contact\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}
