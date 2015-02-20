<?php

/**
 * @method Cms\Model\Mail\Server\Query limit() limit($limit = null)
 * @method Cms\Model\Mail\Server\Query offset() offset($offset = null)
 * @method Cms\Model\Mail\Server\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Server\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Server\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Server\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Server\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method Cms\Model\Mail\Server\Query resetOrder() resetOrder()
 * @method Cms\Model\Mail\Server\Query resetWhere() resetWhere()
 * @method Cms\Model\Mail\Server\Query\Field andField() andField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Server\Query\Field where() where($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Server\Query\Field orField() orField($fieldName, $tableName = null)
 * @method Cms\Model\Mail\Server\Query\Join join() join($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Server\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms\Model\Mail\Server\Record[] find() find()
 * @method Cms\Model\Mail\Server\Record findFirst() findFirst()
 */

namespace Cms\Model\Mail\Server;

class Query extends \Mmi\Dao\Query {

	/**
	 * @return Cms\Model\Mail\Server\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereAddress() {
		return $this->where('address');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldAddress() {
		return $this->andField('address');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldAddress() {
		return $this->orField('address');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscAddress() {
		return $this->orderAsc('address');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescAddress() {
		return $this->orderDesc('address');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function wherePort() {
		return $this->where('port');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldPort() {
		return $this->andField('port');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldPort() {
		return $this->orField('port');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscPort() {
		return $this->orderAsc('port');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescPort() {
		return $this->orderDesc('port');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereUsername() {
		return $this->where('username');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldUsername() {
		return $this->andField('username');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldUsername() {
		return $this->orField('username');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscUsername() {
		return $this->orderAsc('username');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescUsername() {
		return $this->orderDesc('username');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function wherePassword() {
		return $this->where('password');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldPassword() {
		return $this->andField('password');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldPassword() {
		return $this->orField('password');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscPassword() {
		return $this->orderAsc('password');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescPassword() {
		return $this->orderDesc('password');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereFrom() {
		return $this->where('from');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldFrom() {
		return $this->andField('from');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldFrom() {
		return $this->orField('from');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscFrom() {
		return $this->orderAsc('from');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescFrom() {
		return $this->orderDesc('from');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereDateModify() {
		return $this->where('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldDateModify() {
		return $this->andField('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldDateModify() {
		return $this->orField('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscDateModify() {
		return $this->orderAsc('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescDateModify() {
		return $this->orderDesc('dateModify');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function whereSsl() {
		return $this->where('ssl');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function andFieldSsl() {
		return $this->andField('ssl');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orFieldSsl() {
		return $this->orField('ssl');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderAscSsl() {
		return $this->orderAsc('ssl');
	}

	/**
	 * @return Cms\Model\Mail\Server\Query\Field
	 */
	public function orderDescSsl() {
		return $this->orderDesc('ssl');
	}

}