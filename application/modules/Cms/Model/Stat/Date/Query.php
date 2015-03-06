<?php

namespace Cms\Model\Stat\Date;

/**
 * @method \Cms\Model\Stat\Date\Query limit($limit = null)
 * @method \Cms\Model\Stat\Date\Query offset($offset = null)
 * @method \Cms\Model\Stat\Date\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Date\Query resetOrder()
 * @method \Cms\Model\Stat\Date\Query resetWhere()
 * @method \Cms\Model\Stat\Date\Query\Field whereId()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldId()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldId()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscId()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescId()
 * @method \Cms\Model\Stat\Date\Query\Field whereHour()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldHour()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldHour()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscHour()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescHour()
 * @method \Cms\Model\Stat\Date\Query\Field whereDay()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldDay()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldDay()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscDay()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescDay()
 * @method \Cms\Model\Stat\Date\Query\Field whereMonth()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldMonth()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldMonth()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscMonth()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescMonth()
 * @method \Cms\Model\Stat\Date\Query\Field whereYear()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldYear()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldYear()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscYear()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescYear()
 * @method \Cms\Model\Stat\Date\Query\Field whereObject()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldObject()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldObject()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscObject()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescObject()
 * @method \Cms\Model\Stat\Date\Query\Field whereObjectId()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldObjectId()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldObjectId()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscObjectId()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescObjectId()
 * @method \Cms\Model\Stat\Date\Query\Field whereCount()
 * @method \Cms\Model\Stat\Date\Query\Field andFieldCount()
 * @method \Cms\Model\Stat\Date\Query\Field orFieldCount()
 * @method \Cms\Model\Stat\Date\Query\Field orderAscCount()
 * @method \Cms\Model\Stat\Date\Query\Field orderDescCount()
 * @method \Cms\Model\Stat\Date\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Date\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Date\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Date\Record[] find()
 * @method \Cms\Model\Stat\Date\Record findFirst()
 * @method \Cms\Model\Stat\Date\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Stat\Date\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
