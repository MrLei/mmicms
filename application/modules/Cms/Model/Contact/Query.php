<?php

/**
 * @method Cms_Model_Contact_Query limit() limit($limit = null)
 * @method Cms_Model_Contact_Query offset() offset($offset = null)
 * @method Cms_Model_Contact_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Contact_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Contact_Query resetOrder() resetOrder()
 * @method Cms_Model_Contact_Query resetWhere() resetWhere()
 * @method Cms_Model_Contact_Record[] find() find()
 * @method Cms_Model_Contact_Record findFirst() findFirst()
 */
class Cms_Model_Contact_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Contact_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereCmsContactOptionId() {
		return $this->where('cmsContactOptionId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldCmsContactOptionId() {
		return $this->andField('cmsContactOptionId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldCmsContactOptionId() {
		return $this->orField('cmsContactOptionId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscCmsContactOptionId() {
		return $this->orderAsc('cmsContactOptionId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescCmsContactOptionId() {
		return $this->orderDesc('cmsContactOptionId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereReply() {
		return $this->where('reply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldReply() {
		return $this->andField('reply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldReply() {
		return $this->orField('reply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscReply() {
		return $this->orderAsc('reply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescReply() {
		return $this->orderDesc('reply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereCmsAuthIdReply() {
		return $this->where('cmsAuthIdReply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldCmsAuthIdReply() {
		return $this->andField('cmsAuthIdReply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldCmsAuthIdReply() {
		return $this->orField('cmsAuthIdReply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscCmsAuthIdReply() {
		return $this->orderAsc('cmsAuthIdReply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescCmsAuthIdReply() {
		return $this->orderDesc('cmsAuthIdReply');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function wherePhone() {
		return $this->where('phone');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldPhone() {
		return $this->andField('phone');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldPhone() {
		return $this->orField('phone');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscPhone() {
		return $this->orderAsc('phone');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescPhone() {
		return $this->orderDesc('phone');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereEmail() {
		return $this->where('email');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldEmail() {
		return $this->andField('email');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldEmail() {
		return $this->orField('email');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscEmail() {
		return $this->orderAsc('email');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescEmail() {
		return $this->orderDesc('email');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Contact_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Contact_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Contact_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}