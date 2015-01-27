<?php

/**
 * @method Cms_Model_Widget_Picture_Query limit() limit($limit = null)
 * @method Cms_Model_Widget_Picture_Query offset() offset($offset = null)
 * @method Cms_Model_Widget_Picture_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Picture_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Picture_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Picture_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Picture_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Widget_Picture_Query resetOrder() resetOrder()
 * @method Cms_Model_Widget_Picture_Query resetWhere() resetWhere()
 * @method Cms_Model_Widget_Picture_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Picture_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Picture_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Widget_Picture_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Widget_Picture_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Widget_Picture_Record[] find() find()
 * @method Cms_Model_Widget_Picture_Record findFirst() findFirst()
 */
class Cms_Model_Widget_Picture_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Widget_Picture_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Widget_Picture_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

}