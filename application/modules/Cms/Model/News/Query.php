<?php

/**
 * @method Cms_Model_News_Query limit() limit($limit = null)
 * @method Cms_Model_News_Query offset() offset($offset = null)
 * @method Cms_Model_News_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_News_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_News_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_News_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_News_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_News_Query resetOrder() resetOrder()
 * @method Cms_Model_News_Query resetWhere() resetWhere()
 * @method Cms_Model_News_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_News_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_News_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_News_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_News_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_News_Record[] find() find()
 * @method Cms_Model_News_Record findFirst() findFirst()
 */
class Cms_Model_News_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_News_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereLead() {
		return $this->where('lead');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldLead() {
		return $this->andField('lead');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldLead() {
		return $this->orField('lead');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscLead() {
		return $this->orderAsc('lead');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescLead() {
		return $this->orderDesc('lead');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereInternal() {
		return $this->where('internal');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldInternal() {
		return $this->andField('internal');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldInternal() {
		return $this->orField('internal');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscInternal() {
		return $this->orderAsc('internal');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescInternal() {
		return $this->orderDesc('internal');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function whereVisible() {
		return $this->where('visible');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function andFieldVisible() {
		return $this->andField('visible');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orFieldVisible() {
		return $this->orField('visible');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderAscVisible() {
		return $this->orderAsc('visible');
	}

	/**
	 * @return Cms_Model_News_Query_Field
	 */
	public function orderDescVisible() {
		return $this->orderDesc('visible');
	}

}