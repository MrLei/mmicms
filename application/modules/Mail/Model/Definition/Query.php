<?php

/**
 * @method Mail_Model_Definition_Query limit() limit($limit = null)
 * @method Mail_Model_Definition_Query offset() offset($offset = null)
 * @method Mail_Model_Definition_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Mail_Model_Definition_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Mail_Model_Definition_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Definition_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Definition_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Mail_Model_Definition_Query andField() andField($fieldName, $tableName = null)
 * @method Mail_Model_Definition_Query where() where($fieldName, $tableName = null)
 * @method Mail_Model_Definition_Query orField() orField($fieldName, $tableName = null)
 * @method Mail_Model_Definition_Query resetOrder() resetOrder()
 * @method Mail_Model_Definition_Query resetWhere() resetWhere()
 */
class Mail_Model_Definition_Query extends Mmi_Dao_Query {

	public function __construct() {
		return parent::__construct('Mail_Model_Definition_Dao');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereMail_server_id() {
		return $this->where('mail_server_id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldMail_server_id() {
		return $this->andField('mail_server_id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldMail_server_id() {
		return $this->orField('mail_server_id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscMail_server_id() {
		return $this->orderAsc('mail_server_id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescMail_server_id() {
		return $this->orderDesc('mail_server_id');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereHtml() {
		return $this->where('html');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldHtml() {
		return $this->andField('html');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldHtml() {
		return $this->orField('html');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscHtml() {
		return $this->orderAsc('html');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescHtml() {
		return $this->orderDesc('html');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Mail_Model_Definition_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mail_Model_Definition_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return parent::join($tableName, $targetTableName);
	}

	/**
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mail_Model_Definition_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return parent::joinLeft($tableName, $targetTableName);
	}

}