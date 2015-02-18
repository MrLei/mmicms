<?php

/**
 * @method Cms_Model_Mail_Query limit() limit($limit = null)
 * @method Cms_Model_Mail_Query offset() offset($offset = null)
 * @method Cms_Model_Mail_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Query resetOrder() resetOrder()
 * @method Cms_Model_Mail_Query resetWhere() resetWhere()
 * @method Cms_Model_Mail_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Record[] find() find()
 * @method Cms_Model_Mail_Record findFirst() findFirst()
 */
class Cms_Model_Mail_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Mail_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereMailDefinitionId() {
		return $this->where('mailDefinitionId');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldMailDefinitionId() {
		return $this->andField('mailDefinitionId');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldMailDefinitionId() {
		return $this->orField('mailDefinitionId');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscMailDefinitionId() {
		return $this->orderAsc('mailDefinitionId');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescMailDefinitionId() {
		return $this->orderDesc('mailDefinitionId');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereTo() {
		return $this->where('to');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldTo() {
		return $this->andField('to');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldTo() {
		return $this->orField('to');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscTo() {
		return $this->orderAsc('to');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescTo() {
		return $this->orderDesc('to');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereAttachements() {
		return $this->where('attachements');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldAttachements() {
		return $this->andField('attachements');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldAttachements() {
		return $this->orField('attachements');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscAttachements() {
		return $this->orderAsc('attachements');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescAttachements() {
		return $this->orderDesc('attachements');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereType() {
		return $this->where('type');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldType() {
		return $this->andField('type');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldType() {
		return $this->orField('type');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscType() {
		return $this->orderAsc('type');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescType() {
		return $this->orderDesc('type');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereDateSent() {
		return $this->where('dateSent');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldDateSent() {
		return $this->andField('dateSent');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldDateSent() {
		return $this->orField('dateSent');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscDateSent() {
		return $this->orderAsc('dateSent');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescDateSent() {
		return $this->orderDesc('dateSent');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereDateSendAfter() {
		return $this->where('dateSendAfter');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldDateSendAfter() {
		return $this->andField('dateSendAfter');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldDateSendAfter() {
		return $this->orField('dateSendAfter');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscDateSendAfter() {
		return $this->orderAsc('dateSendAfter');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescDateSendAfter() {
		return $this->orderDesc('dateSendAfter');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Mail_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}