<?php

/**
 * @method \Cms\Model\Auth\Query limit() limit($limit = null)
 * @method \Cms\Model\Auth\Query offset() offset($offset = null)
 * @method \Cms\Model\Auth\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query resetOrder() resetOrder()
 * @method \Cms\Model\Auth\Query resetWhere() resetWhere()
 * @method \Cms\Model\Auth\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Record[] find() find()
 * @method \Cms\Model\Auth\Record findFirst() findFirst()
 */

namespace Cms\Model\Auth;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Auth\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLang() {
		return $this->where('lang');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLang() {
		return $this->andField('lang');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLang() {
		return $this->orField('lang');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLang() {
		return $this->orderAsc('lang');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLang() {
		return $this->orderDesc('lang');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereUsername() {
		return $this->where('username');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldUsername() {
		return $this->andField('username');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldUsername() {
		return $this->orField('username');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscUsername() {
		return $this->orderAsc('username');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescUsername() {
		return $this->orderDesc('username');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereEmail() {
		return $this->where('email');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldEmail() {
		return $this->andField('email');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldEmail() {
		return $this->orField('email');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscEmail() {
		return $this->orderAsc('email');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescEmail() {
		return $this->orderDesc('email');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function wherePassword() {
		return $this->where('password');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldPassword() {
		return $this->andField('password');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldPassword() {
		return $this->orField('password');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscPassword() {
		return $this->orderAsc('password');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescPassword() {
		return $this->orderDesc('password');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLastIp() {
		return $this->where('lastIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLastIp() {
		return $this->andField('lastIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLastIp() {
		return $this->orField('lastIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLastIp() {
		return $this->orderAsc('lastIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLastIp() {
		return $this->orderDesc('lastIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLastLog() {
		return $this->where('lastLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLastLog() {
		return $this->andField('lastLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLastLog() {
		return $this->orField('lastLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLastLog() {
		return $this->orderAsc('lastLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLastLog() {
		return $this->orderDesc('lastLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLastFailIp() {
		return $this->where('lastFailIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLastFailIp() {
		return $this->andField('lastFailIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLastFailIp() {
		return $this->orField('lastFailIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLastFailIp() {
		return $this->orderAsc('lastFailIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLastFailIp() {
		return $this->orderDesc('lastFailIp');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLastFailLog() {
		return $this->where('lastFailLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLastFailLog() {
		return $this->andField('lastFailLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLastFailLog() {
		return $this->orField('lastFailLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLastFailLog() {
		return $this->orderAsc('lastFailLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLastFailLog() {
		return $this->orderDesc('lastFailLog');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereFailLogCount() {
		return $this->where('failLogCount');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldFailLogCount() {
		return $this->andField('failLogCount');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldFailLogCount() {
		return $this->orField('failLogCount');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscFailLogCount() {
		return $this->orderAsc('failLogCount');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescFailLogCount() {
		return $this->orderDesc('failLogCount');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereLogged() {
		return $this->where('logged');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldLogged() {
		return $this->andField('logged');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldLogged() {
		return $this->orField('logged');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscLogged() {
		return $this->orderAsc('logged');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescLogged() {
		return $this->orderDesc('logged');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Auth\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

}