<?php

/**
 * @method Cms_Model_Log_Query limit() limit($limit = null)
 * @method Cms_Model_Log_Query offset() offset($offset = null)
 * @method Cms_Model_Log_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Log_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Log_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Log_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Log_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Log_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Log_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Log_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Log_Query resetOrder() resetOrder()
 * @method Cms_Model_Log_Query resetWhere() resetWhere()
 * @method Cms_Model_Log_Record[] find() find()
 * @method Cms_Model_Log_Record findFirst() findFirst()
 */
class Cms_Model_Log_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Log_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereUrl() {
		return $this->where('url');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldUrl() {
		return $this->andField('url');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldUrl() {
		return $this->orField('url');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscUrl() {
		return $this->orderAsc('url');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescUrl() {
		return $this->orderDesc('url');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereBrowser() {
		return $this->where('browser');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldBrowser() {
		return $this->andField('browser');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldBrowser() {
		return $this->orField('browser');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscBrowser() {
		return $this->orderAsc('browser');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescBrowser() {
		return $this->orderDesc('browser');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereOperation() {
		return $this->where('operation');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldOperation() {
		return $this->andField('operation');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldOperation() {
		return $this->orField('operation');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscOperation() {
		return $this->orderAsc('operation');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescOperation() {
		return $this->orderDesc('operation');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereSuccess() {
		return $this->where('success');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldSuccess() {
		return $this->andField('success');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldSuccess() {
		return $this->orField('success');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscSuccess() {
		return $this->orderAsc('success');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescSuccess() {
		return $this->orderDesc('success');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function whereDateTime() {
		return $this->where('dateTime');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function andFieldDateTime() {
		return $this->andField('dateTime');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orFieldDateTime() {
		return $this->orField('dateTime');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderAscDateTime() {
		return $this->orderAsc('dateTime');
	}

	/**
	 * @return Cms_Model_Log_Query_Field
	 */
	public function orderDescDateTime() {
		return $this->orderDesc('dateTime');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Log_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Log_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}