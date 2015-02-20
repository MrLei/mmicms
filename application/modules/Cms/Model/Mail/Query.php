<?php

/**
 * @method Cms\Model\Mail\Query limit() limit($limit = null)
 * @method Cms\Model\Mail\Query offset() offset($offset = null)
 * @method Cms\Model\Mail\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Query resetOrder() resetOrder()
 * @method Cms\Model\Mail\Query resetWhere() resetWhere()
 * @method Cms\Model\Mail\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Record[] find() find()
 * @method Cms\Model\Mail\Record findFirst() findFirst()
 */

namespace Cms\Model\Mail;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Mail\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereMailDefinitionId() {
		return $this->where('mailDefinitionId');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldMailDefinitionId() {
		return $this->andField('mailDefinitionId');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldMailDefinitionId() {
		return $this->orField('mailDefinitionId');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscMailDefinitionId() {
		return $this->orderAsc('mailDefinitionId');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescMailDefinitionId() {
		return $this->orderDesc('mailDefinitionId');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereTo() {
		return $this->where('to');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldTo() {
		return $this->andField('to');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldTo() {
		return $this->orField('to');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscTo() {
		return $this->orderAsc('to');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescTo() {
		return $this->orderDesc('to');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereAttachements() {
		return $this->where('attachements');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldAttachements() {
		return $this->andField('attachements');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldAttachements() {
		return $this->orField('attachements');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscAttachements() {
		return $this->orderAsc('attachements');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescAttachements() {
		return $this->orderDesc('attachements');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereType() {
		return $this->where('type');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldType() {
		return $this->andField('type');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldType() {
		return $this->orField('type');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscType() {
		return $this->orderAsc('type');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescType() {
		return $this->orderDesc('type');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereDateSent() {
		return $this->where('dateSent');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldDateSent() {
		return $this->andField('dateSent');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldDateSent() {
		return $this->orField('dateSent');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscDateSent() {
		return $this->orderAsc('dateSent');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescDateSent() {
		return $this->orderDesc('dateSent');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereDateSendAfter() {
		return $this->where('dateSendAfter');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldDateSendAfter() {
		return $this->andField('dateSendAfter');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldDateSendAfter() {
		return $this->orField('dateSendAfter');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscDateSendAfter() {
		return $this->orderAsc('dateSendAfter');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescDateSendAfter() {
		return $this->orderDesc('dateSendAfter');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms\Model\Mail\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}