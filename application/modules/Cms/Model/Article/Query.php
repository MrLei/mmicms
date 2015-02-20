<?php

/**
 * @method \Cms\Model\Article\Query limit() limit($limit = null)
 * @method \Cms\Model\Article\Query offset() offset($offset = null)
 * @method \Cms\Model\Article\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query resetOrder() resetOrder()
 * @method \Cms\Model\Article\Query resetWhere() resetWhere()
 * @method \Cms\Model\Article\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Article\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Article\Record[] find() find()
 * @method \Cms\Model\Article\Record findFirst() findFirst()
 */

namespace Cms\Model\Article;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Article\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereTitle() {
		return $this->where('title');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldTitle() {
		return $this->andField('title');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldTitle() {
		return $this->orField('title');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscTitle() {
		return $this->orderAsc('title');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescTitle() {
		return $this->orderDesc('title');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereUri() {
		return $this->where('uri');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldUri() {
		return $this->andField('uri');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldUri() {
		return $this->orField('uri');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscUri() {
		return $this->orderAsc('uri');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescUri() {
		return $this->orderDesc('uri');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereText() {
		return $this->where('text');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldText() {
		return $this->andField('text');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldText() {
		return $this->orField('text');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscText() {
		return $this->orderAsc('text');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescText() {
		return $this->orderDesc('text');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function whereNoindex() {
		return $this->where('noindex');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function andFieldNoindex() {
		return $this->andField('noindex');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orFieldNoindex() {
		return $this->orField('noindex');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderAscNoindex() {
		return $this->orderAsc('noindex');
	}

	/**
	 * @return \Cms\Model\Article\Query\Field
	 */
	public function orderDescNoindex() {
		return $this->orderDesc('noindex');
	}

}