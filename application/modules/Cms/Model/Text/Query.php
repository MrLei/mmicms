<?php

/**
 * @method Cms_Model_Text_Query limit() limit($limit = null)
 * @method Cms_Model_Text_Query offset() offset($offset = null)
 * @method Cms_Model_Text_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Text_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Text_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Text_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Text_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Text_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Text_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Text_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Text_Query resetOrder() resetOrder()
 * @method Cms_Model_Text_Query resetWhere() resetWhere()
 */
class Cms_Model_Text_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function whereKey() {
		return $this->where('key');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function andFieldKey() {
		return $this->andField('key');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orFieldKey() {
		return $this->orField('key');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderAscKey() {
		return $this->orderAsc('key');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderDescKey() {
		return $this->orderDesc('key');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function whereContent() {
		return $this->where('content');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function andFieldContent() {
		return $this->andField('content');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orFieldContent() {
		return $this->orField('content');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderAscContent() {
		return $this->orderAsc('content');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderDescContent() {
		return $this->orderDesc('content');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_Text_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Text_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Text_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}