<?php

namespace Cms\Model\Cron;

/**
 * @method \Cms\Model\Cron\Query limit() limit($limit = null)
 * @method \Cms\Model\Cron\Query offset() offset($offset = null)
 * @method \Cms\Model\Cron\Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Cron\Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Cron\Query andQuery() andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Cron\Query whereQuery() whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Cron\Query orQuery() orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Cron\Query resetOrder() resetOrder()
 * @method \Cms\Model\Cron\Query resetWhere() resetWhere()
 * @method \Cms\Model\Cron\Query\Field andField() andField($fieldName, $tableName = null)
 * @method \Cms\Model\Cron\Query\Field where() where($fieldName, $tableName = null)
 * @method \Cms\Model\Cron\Query\Field orField() orField($fieldName, $tableName = null)
 * @method \Cms\Model\Cron\Query\Join join() join($tableName, $targetTableName = null)
 * @method \Cms\Model\Cron\Query\Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Cron\Record[] find() find()
 * @method \Cms\Model\Cron\Record findFirst() findFirst()
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Cron\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereMinute() {
		return $this->where('minute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldMinute() {
		return $this->andField('minute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldMinute() {
		return $this->orField('minute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscMinute() {
		return $this->orderAsc('minute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescMinute() {
		return $this->orderDesc('minute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereHour() {
		return $this->where('hour');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldHour() {
		return $this->andField('hour');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldHour() {
		return $this->orField('hour');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscHour() {
		return $this->orderAsc('hour');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescHour() {
		return $this->orderDesc('hour');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDayOfMonth() {
		return $this->where('dayOfMonth');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDayOfMonth() {
		return $this->andField('dayOfMonth');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDayOfMonth() {
		return $this->orField('dayOfMonth');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDayOfMonth() {
		return $this->orderAsc('dayOfMonth');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDayOfMonth() {
		return $this->orderDesc('dayOfMonth');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereMonth() {
		return $this->where('month');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldMonth() {
		return $this->andField('month');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldMonth() {
		return $this->orField('month');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscMonth() {
		return $this->orderAsc('month');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescMonth() {
		return $this->orderDesc('month');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDayOfWeek() {
		return $this->where('dayOfWeek');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDayOfWeek() {
		return $this->andField('dayOfWeek');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDayOfWeek() {
		return $this->orField('dayOfWeek');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDayOfWeek() {
		return $this->orderAsc('dayOfWeek');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDayOfWeek() {
		return $this->orderDesc('dayOfWeek');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDateModified() {
		return $this->where('dateModified');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDateModified() {
		return $this->andField('dateModified');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDateModified() {
		return $this->orField('dateModified');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDateModified() {
		return $this->orderAsc('dateModified');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDateModified() {
		return $this->orderDesc('dateModified');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function whereDateLastExecute() {
		return $this->where('dateLastExecute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function andFieldDateLastExecute() {
		return $this->andField('dateLastExecute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orFieldDateLastExecute() {
		return $this->orField('dateLastExecute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderAscDateLastExecute() {
		return $this->orderAsc('dateLastExecute');
	}

	/**
	 * @return \Cms\Model\Cron\Query\Field
	 */
	public function orderDescDateLastExecute() {
		return $this->orderDesc('dateLastExecute');
	}

}
