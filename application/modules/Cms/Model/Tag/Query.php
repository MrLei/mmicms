<?php

/**
 * @method Cms_Model_Tag_Query limit() limit($limit = null)
 * @method Cms_Model_Tag_Query offset() offset($offset = null)
 * @method Cms_Model_Tag_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Tag_Query resetOrder() resetOrder()
 * @method Cms_Model_Tag_Query resetWhere() resetWhere()
 * @method Cms_Model_Tag_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Tag_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Tag_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Tag_Record[] find() find()
 * @method Cms_Model_Tag_Record findFirst() findFirst()
 */
class Cms_Model_Tag_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Tag_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function whereTag() {
		return $this->where('tag');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function andFieldTag() {
		return $this->andField('tag');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orFieldTag() {
		return $this->orField('tag');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orderAscTag() {
		return $this->orderAsc('tag');
	}

	/**
	 * @return Cms_Model_Tag_Query_Field
	 */
	public function orderDescTag() {
		return $this->orderDesc('tag');
	}

}