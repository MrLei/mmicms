<?php

/**
 * @method Mail_Model_Query limit() limit($limit = null)
 * @method Mail_Model_Query offset() offset($offset = null)
 * @method Mail_Model_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Mail_Model_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Mail_Model_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Mail_Model_Query_Field where() where($fieldName, $tableName = null)
 * @method Mail_Model_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Mail_Model_Query resetOrder() resetOrder()
 * @method Mail_Model_Query resetWhere() resetWhere()
 * @method Mail_Model_Record[] find() find()
 * @method Mail_Model_Record findFirst() findFirst()
 */
class Mail_Model_Query extends Mmi_Dao_Query {

	/**
	 * @return Mail_Model_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereMailDefinitionId() {
		return $this->where('mailDefinitionId');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldMailDefinitionId() {
		return $this->andField('mailDefinitionId');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldMailDefinitionId() {
		return $this->orField('mailDefinitionId');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscMailDefinitionId() {
		return $this->orderAsc('mailDefinitionId');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescMailDefinitionId() {
		return $this->orderDesc('mailDefinitionId');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereTo() {
		return $this->where('to');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldTo() {
		return $this->andField('to');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldTo() {
		return $this->orField('to');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscTo() {
		return $this->orderAsc('to');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescTo() {
		return $this->orderDesc('to');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereAttachements() {
		return $this->where('attachements');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldAttachements() {
		return $this->andField('attachements');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldAttachements() {
		return $this->orField('attachements');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscAttachements() {
		return $this->orderAsc('attachements');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescAttachements() {
		return $this->orderDesc('attachements');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereType() {
		return $this->where('type');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldType() {
		return $this->andField('type');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldType() {
		return $this->orField('type');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscType() {
		return $this->orderAsc('type');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescType() {
		return $this->orderDesc('type');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereDateSent() {
		return $this->where('dateSent');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldDateSent() {
		return $this->andField('dateSent');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldDateSent() {
		return $this->orField('dateSent');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscDateSent() {
		return $this->orderAsc('dateSent');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescDateSent() {
		return $this->orderDesc('dateSent');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereDateSendAfter() {
		return $this->where('dateSendAfter');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldDateSendAfter() {
		return $this->andField('dateSendAfter');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldDateSendAfter() {
		return $this->orField('dateSendAfter');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscDateSendAfter() {
		return $this->orderAsc('dateSendAfter');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescDateSendAfter() {
		return $this->orderDesc('dateSendAfter');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Mail_Model_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mail_Model_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mail_Model_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}