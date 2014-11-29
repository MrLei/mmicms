<?php

/**
 * @method News_Model_Query limit() limit($limit = null)
 * @method News_Model_Query offset() offset($offset = null)
 * @method News_Model_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method News_Model_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method News_Model_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method News_Model_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method News_Model_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method News_Model_Query andField() andField($fieldName, $tableName = null)
 * @method News_Model_Query where() where($fieldName, $tableName = null)
 * @method News_Model_Query orField() orField($fieldName, $tableName = null)
 * @method News_Model_Query resetOrder() resetOrder()
 * @method News_Model_Query resetWhere() resetWhere()
 */
class News_Model_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('News_Model_Dao');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereLead() {
		return $this->where('lead');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldLead() {
		return $this->andField('lead');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldLead() {
		return $this->orField('lead');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscLead() {
		return $this->orderAsc('lead');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescLead() {
		return $this->orderDesc('lead');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereInternal() {
		return $this->where('internal');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldInternal() {
		return $this->andField('internal');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldInternal() {
		return $this->orField('internal');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscInternal() {
		return $this->orderAsc('internal');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescInternal() {
		return $this->orderDesc('internal');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function whereVisible() {
		return $this->where('visible');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function andFieldVisible() {
		return $this->andField('visible');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orFieldVisible() {
		return $this->orField('visible');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderAscVisible() {
		return $this->orderAsc('visible');
	}

	/**
	 * @return News_Model_Query_Field
	 */
	public function orderDescVisible() {
		return $this->orderDesc('visible');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return News_Model_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return News_Model_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}