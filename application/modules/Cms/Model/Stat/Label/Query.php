<?php

/**
 * @method Cms\Model\Stat\Label\Query limit() limit($limit = null)
 * @method Cms\Model\Stat\Label\Query offset() offset($offset = null)
 * @method Cms\Model\Stat\Label\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Stat\Label\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Stat\Label\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Stat\Label\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Stat\Label\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Stat\Label\Query resetOrder() resetOrder()
 * @method Cms\Model\Stat\Label\Query resetWhere() resetWhere()
 * @method Cms\Model\Stat\Label\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Stat\Label\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Stat\Label\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Stat\Label\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Stat\Label\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Stat\Label\Record[] find() find()
 * @method Cms\Model\Stat\Label\Record findFirst() findFirst()
 */

namespace Cms\Model\Stat\Label;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Stat\Label\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function whereObject() {
		return $this->where('object');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function andFieldObject() {
		return $this->andField('object');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orFieldObject() {
		return $this->orField('object');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderAscObject() {
		return $this->orderAsc('object');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderDescObject() {
		return $this->orderDesc('object');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function whereLabel() {
		return $this->where('label');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function andFieldLabel() {
		return $this->andField('label');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orFieldLabel() {
		return $this->orField('label');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderAscLabel() {
		return $this->orderAsc('label');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderDescLabel() {
		return $this->orderDesc('label');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return Cms\Model\Stat\Label\Query\Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

}