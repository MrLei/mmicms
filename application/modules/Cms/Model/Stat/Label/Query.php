<?php

/**
 * @method Cms_Model_Stat_Label_Query limit() limit($limit = null)
 * @method Cms_Model_Stat_Label_Query offset() offset($offset = null)
 * @method Cms_Model_Stat_Label_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Label_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Label_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Label_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Label_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Stat_Label_Query resetOrder() resetOrder()
 * @method Cms_Model_Stat_Label_Query resetWhere() resetWhere()
 * @method Cms_Model_Stat_Label_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Label_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Label_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Stat_Label_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Stat_Label_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Stat_Label_Record[] find() find()
 * @method Cms_Model_Stat_Label_Record findFirst() findFirst()
 */
class Cms_Model_Stat_Label_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Stat_Label_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function whereLabel() {
		return $this->where('label');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function andFieldLabel() {
		return $this->andField('label');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orFieldLabel() {
		return $this->orField('label');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderAscLabel() {
		return $this->orderAsc('label');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderDescLabel() {
		return $this->orderDesc('label');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return Cms_Model_Stat_Label_Query_Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

}