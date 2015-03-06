<?php

namespace Cms\Model\Stat\Label;

/**
 * @method \Cms\Model\Stat\Label\Query limit($limit = null)
 * @method \Cms\Model\Stat\Label\Query offset($offset = null)
 * @method \Cms\Model\Stat\Label\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Label\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Label\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Label\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Label\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Stat\Label\Query resetOrder()
 * @method \Cms\Model\Stat\Label\Query resetWhere()
 * @method \Cms\Model\Stat\Label\Query\Field whereId()
 * @method \Cms\Model\Stat\Label\Query\Field andFieldId()
 * @method \Cms\Model\Stat\Label\Query\Field orFieldId()
 * @method \Cms\Model\Stat\Label\Query\Field orderAscId()
 * @method \Cms\Model\Stat\Label\Query\Field orderDescId()
 * @method \Cms\Model\Stat\Label\Query\Field whereLang()
 * @method \Cms\Model\Stat\Label\Query\Field andFieldLang()
 * @method \Cms\Model\Stat\Label\Query\Field orFieldLang()
 * @method \Cms\Model\Stat\Label\Query\Field orderAscLang()
 * @method \Cms\Model\Stat\Label\Query\Field orderDescLang()
 * @method \Cms\Model\Stat\Label\Query\Field whereObject()
 * @method \Cms\Model\Stat\Label\Query\Field andFieldObject()
 * @method \Cms\Model\Stat\Label\Query\Field orFieldObject()
 * @method \Cms\Model\Stat\Label\Query\Field orderAscObject()
 * @method \Cms\Model\Stat\Label\Query\Field orderDescObject()
 * @method \Cms\Model\Stat\Label\Query\Field whereLabel()
 * @method \Cms\Model\Stat\Label\Query\Field andFieldLabel()
 * @method \Cms\Model\Stat\Label\Query\Field orFieldLabel()
 * @method \Cms\Model\Stat\Label\Query\Field orderAscLabel()
 * @method \Cms\Model\Stat\Label\Query\Field orderDescLabel()
 * @method \Cms\Model\Stat\Label\Query\Field whereDescription()
 * @method \Cms\Model\Stat\Label\Query\Field andFieldDescription()
 * @method \Cms\Model\Stat\Label\Query\Field orFieldDescription()
 * @method \Cms\Model\Stat\Label\Query\Field orderAscDescription()
 * @method \Cms\Model\Stat\Label\Query\Field orderDescDescription()
 * @method \Cms\Model\Stat\Label\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Label\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Label\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Stat\Label\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Label\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Stat\Label\Record[] find()
 * @method \Cms\Model\Stat\Label\Record findFirst()
 * @method \Cms\Model\Stat\Label\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Stat\Label\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
