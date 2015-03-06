<?php

namespace Cms\Model\Widget\Text;

/**
 * @method \Cms\Model\Widget\Text\Query limit($limit = null)
 * @method \Cms\Model\Widget\Text\Query offset($offset = null)
 * @method \Cms\Model\Widget\Text\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Text\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Text\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Text\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Text\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Widget\Text\Query resetOrder()
 * @method \Cms\Model\Widget\Text\Query resetWhere()
 * @method \Cms\Model\Widget\Text\Query\Field whereId()
 * @method \Cms\Model\Widget\Text\Query\Field andFieldId()
 * @method \Cms\Model\Widget\Text\Query\Field orFieldId()
 * @method \Cms\Model\Widget\Text\Query\Field orderAscId()
 * @method \Cms\Model\Widget\Text\Query\Field orderDescId()
 * @method \Cms\Model\Widget\Text\Query\Field whereData()
 * @method \Cms\Model\Widget\Text\Query\Field andFieldData()
 * @method \Cms\Model\Widget\Text\Query\Field orFieldData()
 * @method \Cms\Model\Widget\Text\Query\Field orderAscData()
 * @method \Cms\Model\Widget\Text\Query\Field orderDescData()
 * @method \Cms\Model\Widget\Text\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Text\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Text\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Widget\Text\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Text\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Widget\Text\Record[] find()
 * @method \Cms\Model\Widget\Text\Record findFirst()
 * @method \Cms\Model\Widget\Text\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Widget\Text\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
