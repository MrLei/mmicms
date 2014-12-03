<?php

/**
 * @method Cms_Model_Comment_Query limit() limit($limit = null)
 * @method Cms_Model_Comment_Query offset() offset($offset = null)
 * @method Cms_Model_Comment_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Comment_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Comment_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Comment_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Comment_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Comment_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Comment_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Comment_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Comment_Query resetOrder() resetOrder()
 * @method Cms_Model_Comment_Query resetWhere() resetWhere()
 * @method Mmi_Dao_Record_Collection find() find()
 * @method Cms_Model_Comment_Record findFirst() findFirst()
 */
class Cms_Model_Comment_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Comment_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereCmsAuthId() {
		return $this->where('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldCmsAuthId() {
		return $this->andField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldCmsAuthId() {
		return $this->orField('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscCmsAuthId() {
		return $this->orderAsc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescCmsAuthId() {
		return $this->orderDesc('cmsAuthId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereParentId() {
		return $this->where('parentId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldParentId() {
		return $this->andField('parentId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldParentId() {
		return $this->orField('parentId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscParentId() {
		return $this->orderAsc('parentId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescParentId() {
		return $this->orderDesc('parentId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereSignature() {
		return $this->where('signature');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldSignature() {
		return $this->andField('signature');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldSignature() {
		return $this->orField('signature');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscSignature() {
		return $this->orderAsc('signature');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescSignature() {
		return $this->orderDesc('signature');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereIp() {
		return $this->where('ip');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldIp() {
		return $this->andField('ip');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldIp() {
		return $this->orField('ip');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscIp() {
		return $this->orderAsc('ip');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescIp() {
		return $this->orderDesc('ip');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereStars() {
		return $this->where('stars');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldStars() {
		return $this->andField('stars');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldStars() {
		return $this->orField('stars');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscStars() {
		return $this->orderAsc('stars');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescStars() {
		return $this->orderDesc('stars');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Cms_Model_Comment_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Comment_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Comment_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}