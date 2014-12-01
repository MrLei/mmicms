<?php

/**
 * @method Cms_Model_Navigation_Query limit() limit($limit = null)
 * @method Cms_Model_Navigation_Query offset() offset($offset = null)
 * @method Cms_Model_Navigation_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Navigation_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Navigation_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Navigation_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Navigation_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Navigation_Query andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Navigation_Query where() where($fieldName, $tableName = null)
 * @method Cms_Model_Navigation_Query orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Navigation_Query resetOrder() resetOrder()
 * @method Cms_Model_Navigation_Query resetWhere() resetWhere()
 */
class Cms_Model_Navigation_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('Cms_Model_Navigation_Dao');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereParentId() {
		return $this->where('parentId');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldParentId() {
		return $this->andField('parentId');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldParentId() {
		return $this->orField('parentId');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscParentId() {
		return $this->orderAsc('parentId');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescParentId() {
		return $this->orderDesc('parentId');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereParams() {
		return $this->where('params');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldParams() {
		return $this->andField('params');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldParams() {
		return $this->orField('params');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscParams() {
		return $this->orderAsc('params');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescParams() {
		return $this->orderDesc('params');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereLabel() {
		return $this->where('label');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldLabel() {
		return $this->andField('label');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldLabel() {
		return $this->orField('label');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscLabel() {
		return $this->orderAsc('label');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescLabel() {
		return $this->orderDesc('label');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereKeywords() {
		return $this->where('keywords');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldKeywords() {
		return $this->andField('keywords');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldKeywords() {
		return $this->orField('keywords');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscKeywords() {
		return $this->orderAsc('keywords');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescKeywords() {
		return $this->orderDesc('keywords');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereVisible() {
		return $this->where('visible');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldVisible() {
		return $this->andField('visible');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldVisible() {
		return $this->orField('visible');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscVisible() {
		return $this->orderAsc('visible');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescVisible() {
		return $this->orderDesc('visible');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereDateStart() {
		return $this->where('dateStart');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldDateStart() {
		return $this->andField('dateStart');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldDateStart() {
		return $this->orField('dateStart');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscDateStart() {
		return $this->orderAsc('dateStart');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescDateStart() {
		return $this->orderDesc('dateStart');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereDateEnd() {
		return $this->where('dateEnd');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldDateEnd() {
		return $this->andField('dateEnd');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldDateEnd() {
		return $this->orField('dateEnd');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscDateEnd() {
		return $this->orderAsc('dateEnd');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescDateEnd() {
		return $this->orderDesc('dateEnd');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereAbsolute() {
		return $this->where('absolute');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldAbsolute() {
		return $this->andField('absolute');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldAbsolute() {
		return $this->orField('absolute');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscAbsolute() {
		return $this->orderAsc('absolute');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescAbsolute() {
		return $this->orderDesc('absolute');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereIndependent() {
		return $this->where('independent');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldIndependent() {
		return $this->andField('independent');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldIndependent() {
		return $this->orField('independent');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscIndependent() {
		return $this->orderAsc('independent');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescIndependent() {
		return $this->orderDesc('independent');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereNofollow() {
		return $this->where('nofollow');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldNofollow() {
		return $this->andField('nofollow');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldNofollow() {
		return $this->orField('nofollow');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscNofollow() {
		return $this->orderAsc('nofollow');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescNofollow() {
		return $this->orderDesc('nofollow');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereBlank() {
		return $this->where('blank');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldBlank() {
		return $this->andField('blank');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldBlank() {
		return $this->orField('blank');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscBlank() {
		return $this->orderAsc('blank');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescBlank() {
		return $this->orderDesc('blank');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereHttps() {
		return $this->where('https');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldHttps() {
		return $this->andField('https');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldHttps() {
		return $this->orField('https');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscHttps() {
		return $this->orderAsc('https');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescHttps() {
		return $this->orderDesc('https');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Navigation_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Navigation_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Cms_Model_Navigation_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}