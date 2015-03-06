<?php

namespace Cms\Model\Route;

/**
 * @method \Cms\Model\Route\Query limit($limit = null)
 * @method \Cms\Model\Route\Query offset($offset = null)
 * @method \Cms\Model\Route\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Route\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Route\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Route\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Route\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Route\Query resetOrder()
 * @method \Cms\Model\Route\Query resetWhere()
 * @method \Cms\Model\Route\Query\Field whereId()
 * @method \Cms\Model\Route\Query\Field andFieldId()
 * @method \Cms\Model\Route\Query\Field orFieldId()
 * @method \Cms\Model\Route\Query\Field orderAscId()
 * @method \Cms\Model\Route\Query\Field orderDescId()
 * @method \Cms\Model\Route\Query\Field wherePattern()
 * @method \Cms\Model\Route\Query\Field andFieldPattern()
 * @method \Cms\Model\Route\Query\Field orFieldPattern()
 * @method \Cms\Model\Route\Query\Field orderAscPattern()
 * @method \Cms\Model\Route\Query\Field orderDescPattern()
 * @method \Cms\Model\Route\Query\Field whereReplace()
 * @method \Cms\Model\Route\Query\Field andFieldReplace()
 * @method \Cms\Model\Route\Query\Field orFieldReplace()
 * @method \Cms\Model\Route\Query\Field orderAscReplace()
 * @method \Cms\Model\Route\Query\Field orderDescReplace()
 * @method \Cms\Model\Route\Query\Field whereDefault()
 * @method \Cms\Model\Route\Query\Field andFieldDefault()
 * @method \Cms\Model\Route\Query\Field orFieldDefault()
 * @method \Cms\Model\Route\Query\Field orderAscDefault()
 * @method \Cms\Model\Route\Query\Field orderDescDefault()
 * @method \Cms\Model\Route\Query\Field whereOrder()
 * @method \Cms\Model\Route\Query\Field andFieldOrder()
 * @method \Cms\Model\Route\Query\Field orFieldOrder()
 * @method \Cms\Model\Route\Query\Field orderAscOrder()
 * @method \Cms\Model\Route\Query\Field orderDescOrder()
 * @method \Cms\Model\Route\Query\Field whereActive()
 * @method \Cms\Model\Route\Query\Field andFieldActive()
 * @method \Cms\Model\Route\Query\Field orFieldActive()
 * @method \Cms\Model\Route\Query\Field orderAscActive()
 * @method \Cms\Model\Route\Query\Field orderDescActive()
 * @method \Cms\Model\Route\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Route\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Route\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Route\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Route\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Route\Record[] find()
 * @method \Cms\Model\Route\Record findFirst()
 * @method \Cms\Model\Route\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Route\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
