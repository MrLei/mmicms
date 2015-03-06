<?php

namespace Cms\Model\Contact\Option;

/**
 * @method \Cms\Model\Contact\Option\Query limit($limit = null)
 * @method \Cms\Model\Contact\Option\Query offset($offset = null)
 * @method \Cms\Model\Contact\Option\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Contact\Option\Query resetOrder()
 * @method \Cms\Model\Contact\Option\Query resetWhere()
 * @method \Cms\Model\Contact\Option\Query\Field whereId()
 * @method \Cms\Model\Contact\Option\Query\Field andFieldId()
 * @method \Cms\Model\Contact\Option\Query\Field orFieldId()
 * @method \Cms\Model\Contact\Option\Query\Field orderAscId()
 * @method \Cms\Model\Contact\Option\Query\Field orderDescId()
 * @method \Cms\Model\Contact\Option\Query\Field whereSendTo()
 * @method \Cms\Model\Contact\Option\Query\Field andFieldSendTo()
 * @method \Cms\Model\Contact\Option\Query\Field orFieldSendTo()
 * @method \Cms\Model\Contact\Option\Query\Field orderAscSendTo()
 * @method \Cms\Model\Contact\Option\Query\Field orderDescSendTo()
 * @method \Cms\Model\Contact\Option\Query\Field whereName()
 * @method \Cms\Model\Contact\Option\Query\Field andFieldName()
 * @method \Cms\Model\Contact\Option\Query\Field orFieldName()
 * @method \Cms\Model\Contact\Option\Query\Field orderAscName()
 * @method \Cms\Model\Contact\Option\Query\Field orderDescName()
 * @method \Cms\Model\Contact\Option\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Contact\Option\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Option\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Contact\Option\Record[] find()
 * @method \Cms\Model\Contact\Option\Record findFirst()
 * @method \Cms\Model\Contact\Option\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Contact\Option\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
