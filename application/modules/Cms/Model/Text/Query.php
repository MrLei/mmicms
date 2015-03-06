<?php

namespace Cms\Model\Text;

/**
 * @method \Cms\Model\Text\Query limit($limit = null)
 * @method \Cms\Model\Text\Query offset($offset = null)
 * @method \Cms\Model\Text\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Text\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Text\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Text\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Text\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Text\Query resetOrder()
 * @method \Cms\Model\Text\Query resetWhere()
 * @method \Cms\Model\Text\Query\Field whereId()
 * @method \Cms\Model\Text\Query\Field andFieldId()
 * @method \Cms\Model\Text\Query\Field orFieldId()
 * @method \Cms\Model\Text\Query\Field orderAscId()
 * @method \Cms\Model\Text\Query\Field orderDescId()
 * @method \Cms\Model\Text\Query\Field whereLang()
 * @method \Cms\Model\Text\Query\Field andFieldLang()
 * @method \Cms\Model\Text\Query\Field orFieldLang()
 * @method \Cms\Model\Text\Query\Field orderAscLang()
 * @method \Cms\Model\Text\Query\Field orderDescLang()
 * @method \Cms\Model\Text\Query\Field whereKey()
 * @method \Cms\Model\Text\Query\Field andFieldKey()
 * @method \Cms\Model\Text\Query\Field orFieldKey()
 * @method \Cms\Model\Text\Query\Field orderAscKey()
 * @method \Cms\Model\Text\Query\Field orderDescKey()
 * @method \Cms\Model\Text\Query\Field whereContent()
 * @method \Cms\Model\Text\Query\Field andFieldContent()
 * @method \Cms\Model\Text\Query\Field orFieldContent()
 * @method \Cms\Model\Text\Query\Field orderAscContent()
 * @method \Cms\Model\Text\Query\Field orderDescContent()
 * @method \Cms\Model\Text\Query\Field whereDateModify()
 * @method \Cms\Model\Text\Query\Field andFieldDateModify()
 * @method \Cms\Model\Text\Query\Field orFieldDateModify()
 * @method \Cms\Model\Text\Query\Field orderAscDateModify()
 * @method \Cms\Model\Text\Query\Field orderDescDateModify()
 * @method \Cms\Model\Text\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Text\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Text\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Text\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Text\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Text\Record[] find()
 * @method \Cms\Model\Text\Record findFirst()
 * @method \Cms\Model\Text\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Text\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
