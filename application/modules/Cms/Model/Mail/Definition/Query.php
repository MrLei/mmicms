<?php

/**
 * @method Cms\Model\Mail\Definition\Query limit() limit($limit = null)
 * @method Cms\Model\Mail\Definition\Query offset() offset($offset = null)
 * @method Cms\Model\Mail\Definition\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Definition\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Definition\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Definition\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Definition\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Definition\Query resetOrder() resetOrder()
 * @method Cms\Model\Mail\Definition\Query resetWhere() resetWhere()
 * @method Cms\Model\Mail\Definition\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Definition\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Definition\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Definition\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Definition\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Definition\Record[] find() find()
 * @method Cms\Model\Mail\Definition\Record findFirst() findFirst()
 */

namespace Cms\Model\Mail\Definition;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Mail\Definition\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereMailServerId() {
		return $this->where('mailServerId');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldMailServerId() {
		return $this->andField('mailServerId');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldMailServerId() {
		return $this->orField('mailServerId');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscMailServerId() {
		return $this->orderAsc('mailServerId');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescMailServerId() {
		return $this->orderDesc('mailServerId');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereHtml() {
		return $this->where('html');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldHtml() {
		return $this->andField('html');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldHtml() {
		return $this->orField('html');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscHtml() {
		return $this->orderAsc('html');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescHtml() {
		return $this->orderDesc('html');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms\Model\Mail\Definition\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}