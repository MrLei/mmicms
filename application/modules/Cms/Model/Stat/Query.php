<?php

namespace Cms\Model\Stat;

/**
 * @method \Cms\Model\Stat\Query limit($limit = null)
 * @method \Cms\Model\Stat\Query offset($offset = null)
 * @method \Cms\Model\Stat\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Query resetOrder()
 * @method \Cms\Model\Stat\Query resetWhere()
 * @method \Cms\Model\Stat\Query\Field whereId()
 * @method \Cms\Model\Stat\Query\Field andFieldId()
 * @method \Cms\Model\Stat\Query\Field orFieldId()
 * @method \Cms\Model\Stat\Query\Field orderAscId()
 * @method \Cms\Model\Stat\Query\Field orderDescId()
 * @method \Cms\Model\Stat\Query\Field whereObject()
 * @method \Cms\Model\Stat\Query\Field andFieldObject()
 * @method \Cms\Model\Stat\Query\Field orFieldObject()
 * @method \Cms\Model\Stat\Query\Field orderAscObject()
 * @method \Cms\Model\Stat\Query\Field orderDescObject()
 * @method \Cms\Model\Stat\Query\Field whereObjectId()
 * @method \Cms\Model\Stat\Query\Field andFieldObjectId()
 * @method \Cms\Model\Stat\Query\Field orFieldObjectId()
 * @method \Cms\Model\Stat\Query\Field orderAscObjectId()
 * @method \Cms\Model\Stat\Query\Field orderDescObjectId()
 * @method \Cms\Model\Stat\Query\Field whereDateTime()
 * @method \Cms\Model\Stat\Query\Field andFieldDateTime()
 * @method \Cms\Model\Stat\Query\Field orFieldDateTime()
 * @method \Cms\Model\Stat\Query\Field orderAscDateTime()
 * @method \Cms\Model\Stat\Query\Field orderDescDateTime()
 * @method \Cms\Model\Stat\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Record[] find()
 * @method \Cms\Model\Stat\Record findFirst()
 * @method \Cms\Model\Stat\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Stat\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
