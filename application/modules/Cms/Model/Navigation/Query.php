<?php

namespace Cms\Model\Navigation;

/**
 * @method \Cms\Model\Navigation\Query limit() limit($limit = null)
 * @method \Cms\Model\Navigation\Query offset() offset($offset = null)
 * @method \Cms\Model\Navigation\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query resetOrder() resetOrder()
 * @method \Cms\Model\Navigation\Query resetWhere() resetWhere()
 * @method \Cms\Model\Navigation\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Navigation\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Navigation\Record[] find() find()
 * @method \Cms\Model\Navigation\Record findFirst() findFirst()
 * @method \Cms\Model\Navigation\Record findPk() findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Navigation\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereParentId() {
		return $this->where('parentId');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldParentId() {
		return $this->andField('parentId');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldParentId() {
		return $this->orField('parentId');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscParentId() {
		return $this->orderAsc('parentId');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescParentId() {
		return $this->orderDesc('parentId');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereOrder() {
		return $this->where('order');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldOrder() {
		return $this->andField('order');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldOrder() {
		return $this->orField('order');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscOrder() {
		return $this->orderAsc('order');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescOrder() {
		return $this->orderDesc('order');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereParams() {
		return $this->where('params');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldParams() {
		return $this->andField('params');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldParams() {
		return $this->orField('params');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscParams() {
		return $this->orderAsc('params');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescParams() {
		return $this->orderDesc('params');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereLabel() {
		return $this->where('label');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldLabel() {
		return $this->andField('label');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldLabel() {
		return $this->orField('label');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscLabel() {
		return $this->orderAsc('label');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescLabel() {
		return $this->orderDesc('label');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereKeywords() {
		return $this->where('keywords');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldKeywords() {
		return $this->andField('keywords');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldKeywords() {
		return $this->orField('keywords');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscKeywords() {
		return $this->orderAsc('keywords');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescKeywords() {
		return $this->orderDesc('keywords');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereVisible() {
		return $this->where('visible');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldVisible() {
		return $this->andField('visible');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldVisible() {
		return $this->orField('visible');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscVisible() {
		return $this->orderAsc('visible');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescVisible() {
		return $this->orderDesc('visible');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereDateStart() {
		return $this->where('dateStart');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldDateStart() {
		return $this->andField('dateStart');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldDateStart() {
		return $this->orField('dateStart');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscDateStart() {
		return $this->orderAsc('dateStart');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescDateStart() {
		return $this->orderDesc('dateStart');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereDateEnd() {
		return $this->where('dateEnd');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldDateEnd() {
		return $this->andField('dateEnd');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldDateEnd() {
		return $this->orField('dateEnd');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscDateEnd() {
		return $this->orderAsc('dateEnd');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescDateEnd() {
		return $this->orderDesc('dateEnd');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereAbsolute() {
		return $this->where('absolute');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldAbsolute() {
		return $this->andField('absolute');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldAbsolute() {
		return $this->orField('absolute');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscAbsolute() {
		return $this->orderAsc('absolute');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescAbsolute() {
		return $this->orderDesc('absolute');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereIndependent() {
		return $this->where('independent');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldIndependent() {
		return $this->andField('independent');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldIndependent() {
		return $this->orField('independent');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscIndependent() {
		return $this->orderAsc('independent');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescIndependent() {
		return $this->orderDesc('independent');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereNofollow() {
		return $this->where('nofollow');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldNofollow() {
		return $this->andField('nofollow');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldNofollow() {
		return $this->orField('nofollow');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscNofollow() {
		return $this->orderAsc('nofollow');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescNofollow() {
		return $this->orderDesc('nofollow');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereBlank() {
		return $this->where('blank');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldBlank() {
		return $this->andField('blank');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldBlank() {
		return $this->orField('blank');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscBlank() {
		return $this->orderAsc('blank');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescBlank() {
		return $this->orderDesc('blank');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereHttps() {
		return $this->where('https');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldHttps() {
		return $this->andField('https');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldHttps() {
		return $this->orField('https');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscHttps() {
		return $this->orderAsc('https');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescHttps() {
		return $this->orderDesc('https');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Navigation\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}
