<?php

namespace Cms\Model\Role;

/**
 * @method \Cms\Model\Role\Query limit($limit = null)
 * @method \Cms\Model\Role\Query offset($offset = null)
 * @method \Cms\Model\Role\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Role\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Role\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Role\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Role\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Role\Query resetOrder()
 * @method \Cms\Model\Role\Query resetWhere()
 * @method \Cms\Model\Role\Query\Field whereId()
 * @method \Cms\Model\Role\Query\Field andFieldId()
 * @method \Cms\Model\Role\Query\Field orFieldId()
 * @method \Cms\Model\Role\Query\Field orderAscId()
 * @method \Cms\Model\Role\Query\Field orderDescId()
 * @method \Cms\Model\Role\Query\Field whereName()
 * @method \Cms\Model\Role\Query\Field andFieldName()
 * @method \Cms\Model\Role\Query\Field orFieldName()
 * @method \Cms\Model\Role\Query\Field orderAscName()
 * @method \Cms\Model\Role\Query\Field orderDescName()
 * @method \Cms\Model\Role\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Role\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Role\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Role\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Role\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Role\Record[] find()
 * @method \Cms\Model\Role\Record findFirst()
 * @method \Cms\Model\Role\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Role\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
