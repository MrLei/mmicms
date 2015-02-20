<?php

/**
 * @method Cms\Model\Text\Query limit() limit($limit = null)
 * @method Cms\Model\Text\Query offset() offset($offset = null)
 * @method Cms\Model\Text\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Text\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Text\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Text\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Text\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Text\Query resetOrder() resetOrder()
 * @method Cms\Model\Text\Query resetWhere() resetWhere()
 * @method Cms\Model\Text\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Text\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Text\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Text\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Text\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Text\Record[] find() find()
 * @method Cms\Model\Text\Record findFirst() findFirst()
 */

namespace Cms\Model\Text;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Text\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function whereKey() {
		return $this->where('key');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function andFieldKey() {
		return $this->andField('key');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orFieldKey() {
		return $this->orField('key');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderAscKey() {
		return $this->orderAsc('key');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderDescKey() {
		return $this->orderDesc('key');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function whereContent() {
		return $this->where('content');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function andFieldContent() {
		return $this->andField('content');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orFieldContent() {
		return $this->orField('content');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderAscContent() {
		return $this->orderAsc('content');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderDescContent() {
		return $this->orderDesc('content');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms\Model\Text\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

}