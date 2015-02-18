<?php

/**
 * @method Cms_Model_Mail_Definition_Query limit() limit($limit = null)
 * @method Cms_Model_Mail_Definition_Query offset() offset($offset = null)
 * @method Cms_Model_Mail_Definition_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Definition_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Definition_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Definition_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Definition_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Mail_Definition_Query resetOrder() resetOrder()
 * @method Cms_Model_Mail_Definition_Query resetWhere() resetWhere()
 * @method Cms_Model_Mail_Definition_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Definition_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Definition_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Mail_Definition_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Definition_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Mail_Definition_Record[] find() find()
 * @method Cms_Model_Mail_Definition_Record findFirst() findFirst()
 */
class Cms_Model_Mail_Definition_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Mail_Definition_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereMailServerId() {
		return $this->where('mailServerId');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldMailServerId() {
		return $this->andField('mailServerId');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldMailServerId() {
		return $this->orField('mailServerId');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscMailServerId() {
		return $this->orderAsc('mailServerId');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescMailServerId() {
		return $this->orderDesc('mailServerId');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereReplyTo() {
		return $this->where('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldReplyTo() {
		return $this->andField('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldReplyTo() {
		return $this->orField('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscReplyTo() {
		return $this->orderAsc('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescReplyTo() {
		return $this->orderDesc('replyTo');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereFromName() {
		return $this->where('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldFromName() {
		return $this->andField('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldFromName() {
		return $this->orField('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscFromName() {
		return $this->orderAsc('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescFromName() {
		return $this->orderDesc('fromName');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereSubject() {
		return $this->where('subject');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldSubject() {
		return $this->andField('subject');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldSubject() {
		return $this->orField('subject');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscSubject() {
		return $this->orderAsc('subject');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescSubject() {
		return $this->orderDesc('subject');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereMessage() {
		return $this->where('message');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldMessage() {
		return $this->andField('message');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldMessage() {
		return $this->orField('message');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscMessage() {
		return $this->orderAsc('message');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescMessage() {
		return $this->orderDesc('message');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereHtml() {
		return $this->where('html');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldHtml() {
		return $this->andField('html');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldHtml() {
		return $this->orField('html');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscHtml() {
		return $this->orderAsc('html');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescHtml() {
		return $this->orderDesc('html');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Mail_Definition_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}