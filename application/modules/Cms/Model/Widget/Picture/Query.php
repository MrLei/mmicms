<?php

namespace Cms\Model\Widget\Picture;

/**
 * @method \Cms\Model\Widget\Picture\Query limit($limit = null)
 * @method \Cms\Model\Widget\Picture\Query offset($offset = null)
 * @method \Cms\Model\Widget\Picture\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Picture\Query resetOrder()
 * @method \Cms\Model\Widget\Picture\Query resetWhere()
 * @method \Cms\Model\Widget\Picture\Query\Field whereId()
 * @method \Cms\Model\Widget\Picture\Query\Field andFieldId()
 * @method \Cms\Model\Widget\Picture\Query\Field orFieldId()
 * @method \Cms\Model\Widget\Picture\Query\Field orderAscId()
 * @method \Cms\Model\Widget\Picture\Query\Field orderDescId()
 * @method \Cms\Model\Widget\Picture\Query\Field whereDateAdd()
 * @method \Cms\Model\Widget\Picture\Query\Field andFieldDateAdd()
 * @method \Cms\Model\Widget\Picture\Query\Field orFieldDateAdd()
 * @method \Cms\Model\Widget\Picture\Query\Field orderAscDateAdd()
 * @method \Cms\Model\Widget\Picture\Query\Field orderDescDateAdd()
 * @method \Cms\Model\Widget\Picture\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Picture\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Picture\Record[] find()
 * @method \Cms\Model\Widget\Picture\Record findFirst()
 * @method \Cms\Model\Widget\Picture\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Widget\Picture\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
