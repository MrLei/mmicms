<?php

/**
 * @method Cms_Model_Cron_Query limit() limit($limit = null)
 * @method Cms_Model_Cron_Query offset() offset($offset = null)
 * @method Cms_Model_Cron_Query orderAsc() orderAsc($fieldName, $tableName = null)
 * @method Cms_Model_Cron_Query orderDesc() orderDesc($fieldName, $tableName = null)
 * @method Cms_Model_Cron_Query andQuery() andQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Cron_Query whereQuery() whereQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Cron_Query orQuery() orQuery(Mmi_Dao_Query $query)
 * @method Cms_Model_Cron_Query resetOrder() resetOrder()
 * @method Cms_Model_Cron_Query resetWhere() resetWhere()
 * @method Cms_Model_Cron_Query_Field andField() andField($fieldName, $tableName = null)
 * @method Cms_Model_Cron_Query_Field where() where($fieldName, $tableName = null)
 * @method Cms_Model_Cron_Query_Field orField() orField($fieldName, $tableName = null)
 * @method Cms_Model_Cron_Query_Join join() join($tableName, $targetTableName = null)
 * @method Cms_Model_Cron_Query_Join joinLeft() joinLeft($tableName, $targetTableName = null)
 * @method Cms_Model_Cron_Record[] find() find()
 * @method Cms_Model_Cron_Record findFirst() findFirst()
 */
class Cms_Model_Cron_Query extends Mmi_Dao_Query {

	/**
	 * @return Cms_Model_Cron_Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereId() {
		return $this->where('id');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldId() {
		return $this->andField('id');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldId() {
		return $this->orField('id');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscId() {
		return $this->orderAsc('id');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescId() {
		return $this->orderDesc('id');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereActive() {
		return $this->where('active');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldActive() {
		return $this->andField('active');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldActive() {
		return $this->orField('active');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscActive() {
		return $this->orderAsc('active');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescActive() {
		return $this->orderDesc('active');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereMinute() {
		return $this->where('minute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldMinute() {
		return $this->andField('minute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldMinute() {
		return $this->orField('minute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscMinute() {
		return $this->orderAsc('minute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescMinute() {
		return $this->orderDesc('minute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereHour() {
		return $this->where('hour');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldHour() {
		return $this->andField('hour');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldHour() {
		return $this->orField('hour');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscHour() {
		return $this->orderAsc('hour');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescHour() {
		return $this->orderDesc('hour');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDayOfMonth() {
		return $this->where('dayOfMonth');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDayOfMonth() {
		return $this->andField('dayOfMonth');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDayOfMonth() {
		return $this->orField('dayOfMonth');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDayOfMonth() {
		return $this->orderAsc('dayOfMonth');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDayOfMonth() {
		return $this->orderDesc('dayOfMonth');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereMonth() {
		return $this->where('month');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldMonth() {
		return $this->andField('month');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldMonth() {
		return $this->orField('month');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscMonth() {
		return $this->orderAsc('month');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescMonth() {
		return $this->orderDesc('month');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDayOfWeek() {
		return $this->where('dayOfWeek');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDayOfWeek() {
		return $this->andField('dayOfWeek');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDayOfWeek() {
		return $this->orField('dayOfWeek');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDayOfWeek() {
		return $this->orderAsc('dayOfWeek');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDayOfWeek() {
		return $this->orderDesc('dayOfWeek');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereName() {
		return $this->where('name');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldName() {
		return $this->andField('name');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldName() {
		return $this->orField('name');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscName() {
		return $this->orderAsc('name');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescName() {
		return $this->orderDesc('name');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDescription() {
		return $this->where('description');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDescription() {
		return $this->andField('description');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDescription() {
		return $this->orField('description');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDescription() {
		return $this->orderAsc('description');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDescription() {
		return $this->orderDesc('description');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereModule() {
		return $this->where('module');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldModule() {
		return $this->andField('module');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldModule() {
		return $this->orField('module');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscModule() {
		return $this->orderAsc('module');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescModule() {
		return $this->orderDesc('module');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereController() {
		return $this->where('controller');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldController() {
		return $this->andField('controller');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldController() {
		return $this->orField('controller');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscController() {
		return $this->orderAsc('controller');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescController() {
		return $this->orderDesc('controller');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereAction() {
		return $this->where('action');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldAction() {
		return $this->andField('action');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldAction() {
		return $this->orField('action');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscAction() {
		return $this->orderAsc('action');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescAction() {
		return $this->orderDesc('action');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDateAdd() {
		return $this->where('dateAdd');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDateAdd() {
		return $this->andField('dateAdd');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDateAdd() {
		return $this->orField('dateAdd');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDateAdd() {
		return $this->orderAsc('dateAdd');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDateAdd() {
		return $this->orderDesc('dateAdd');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDateModified() {
		return $this->where('dateModified');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDateModified() {
		return $this->andField('dateModified');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDateModified() {
		return $this->orField('dateModified');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDateModified() {
		return $this->orderAsc('dateModified');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDateModified() {
		return $this->orderDesc('dateModified');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function whereDateLastExecute() {
		return $this->where('dateLastExecute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function andFieldDateLastExecute() {
		return $this->andField('dateLastExecute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orFieldDateLastExecute() {
		return $this->orField('dateLastExecute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderAscDateLastExecute() {
		return $this->orderAsc('dateLastExecute');
	}

	/**
	 * @return Cms_Model_Cron_Query_Field
	 */
	public function orderDescDateLastExecute() {
		return $this->orderDesc('dateLastExecute');
	}

}