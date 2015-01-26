<?php

/**
 * @method Cms_Model_Widget_Text_Query limit() limit($limit = null)
 * @method Cms_Model_Widget_Text_Query offset() offset($offset = null)
 * @method Cms_Model_Widget_Text_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Text_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Text_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Text_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Text_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Text_Query resetOrder() resetOrder()
 * @method Cms_Model_Widget_Text_Query resetWhere() resetWhere()
 * @method Cms_Model_Widget_Text_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Text_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Text_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Text_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Widget_Text_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Widget_Text_Record[] find() find()
 * @method Cms_Model_Widget_Text_Record findFirst() findFirst()
 */
class Cms_Model_Widget_Text_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Widget_Text_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function whereData() {
		return $this->where('data');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function andFieldData() {
		return $this->andField('data');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orFieldData() {
		return $this->orField('data');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orderAscData() {
		return $this->orderAsc('data');
	}

	/**
	 * @return Cms_Model_Widget_Text_Query_Field
	 */
	public function orderDescData() {
		return $this->orderDesc('data');
	}

}