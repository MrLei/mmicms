<?php

/**
 * @method Cms_Model_Tag_Link_Query limit() limit($limit = null)
 * @method Cms_Model_Tag_Link_Query offset() offset($offset = null)
 * @method Cms_Model_Tag_Link_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Link_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Link_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Link_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Link_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Link_Query resetOrder() resetOrder()
 * @method Cms_Model_Tag_Link_Query resetWhere() resetWhere()
 * @method Cms_Model_Tag_Link_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Link_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Link_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Link_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Tag_Link_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Tag_Link_Record[] find() find()
 * @method Cms_Model_Tag_Link_Record findFirst() findFirst()
 */
class Cms_Model_Tag_Link_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Tag_Link_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function whereCmsTagId() {
		return $this->where('cmsTagId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function andFieldCmsTagId() {
		return $this->andField('cmsTagId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orFieldCmsTagId() {
		return $this->orField('cmsTagId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderAscCmsTagId() {
		return $this->orderAsc('cmsTagId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderDescCmsTagId() {
		return $this->orderDesc('cmsTagId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function whereObjectId() {
		return $this->where('objectId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function andFieldObjectId() {
		return $this->andField('objectId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orFieldObjectId() {
		return $this->orField('objectId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderAscObjectId() {
		return $this->orderAsc('objectId');
	}

	/**
	 * @return Cms_Model_Tag_Link_Query_Field
	 */
	public function orderDescObjectId() {
		return $this->orderDesc('objectId');
	}

}