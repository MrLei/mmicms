<?php

/**
 * @method Cms_Model_Article_Query limit() limit($limit = null)
 * @method Cms_Model_Article_Query offset() offset($offset = null)
 * @method Cms_Model_Article_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Article_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Article_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Article_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Article_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Article_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Article_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Article_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Article_Query resetOrder() resetOrder()
 * @method Cms_Model_Article_Query resetWhere() resetWhere()
 */
class Cms_Model_Article_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function whereNoindex() {
		return $this->where('noindex');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function andFieldNoindex() {
		return $this->andField('noindex');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orFieldNoindex() {
		return $this->orField('noindex');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderAscNoindex() {
		return $this->orderAsc('noindex');
	}

	/**
	 * @return Cms_Model_Article_Query_Field
	 */
	public function orderDescNoindex() {
		return $this->orderDesc('noindex');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Article_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Article_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}