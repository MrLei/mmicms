<?php

namespace Cms\Model\Article;

/**
 * @method \Cms\Model\Article\Query limit($limit = null)
 * @method \Cms\Model\Article\Query offset($offset = null)
 * @method \Cms\Model\Article\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Article\Query resetOrder()
 * @method \Cms\Model\Article\Query resetWhere()
 * @method \Cms\Model\Article\Query\Field whereId()
 * @method \Cms\Model\Article\Query\Field andFieldId()
 * @method \Cms\Model\Article\Query\Field orFieldId()
 * @method \Cms\Model\Article\Query\Field orderAscId()
 * @method \Cms\Model\Article\Query\Field orderDescId()
 * @method \Cms\Model\Article\Query\Field whereLang()
 * @method \Cms\Model\Article\Query\Field andFieldLang()
 * @method \Cms\Model\Article\Query\Field orFieldLang()
 * @method \Cms\Model\Article\Query\Field orderAscLang()
 * @method \Cms\Model\Article\Query\Field orderDescLang()
 * @method \Cms\Model\Article\Query\Field whereTitle()
 * @method \Cms\Model\Article\Query\Field andFieldTitle()
 * @method \Cms\Model\Article\Query\Field orFieldTitle()
 * @method \Cms\Model\Article\Query\Field orderAscTitle()
 * @method \Cms\Model\Article\Query\Field orderDescTitle()
 * @method \Cms\Model\Article\Query\Field whereUri()
 * @method \Cms\Model\Article\Query\Field andFieldUri()
 * @method \Cms\Model\Article\Query\Field orFieldUri()
 * @method \Cms\Model\Article\Query\Field orderAscUri()
 * @method \Cms\Model\Article\Query\Field orderDescUri()
 * @method \Cms\Model\Article\Query\Field whereDateAdd()
 * @method \Cms\Model\Article\Query\Field andFieldDateAdd()
 * @method \Cms\Model\Article\Query\Field orFieldDateAdd()
 * @method \Cms\Model\Article\Query\Field orderAscDateAdd()
 * @method \Cms\Model\Article\Query\Field orderDescDateAdd()
 * @method \Cms\Model\Article\Query\Field whereDateModify()
 * @method \Cms\Model\Article\Query\Field andFieldDateModify()
 * @method \Cms\Model\Article\Query\Field orFieldDateModify()
 * @method \Cms\Model\Article\Query\Field orderAscDateModify()
 * @method \Cms\Model\Article\Query\Field orderDescDateModify()
 * @method \Cms\Model\Article\Query\Field whereText()
 * @method \Cms\Model\Article\Query\Field andFieldText()
 * @method \Cms\Model\Article\Query\Field orFieldText()
 * @method \Cms\Model\Article\Query\Field orderAscText()
 * @method \Cms\Model\Article\Query\Field orderDescText()
 * @method \Cms\Model\Article\Query\Field whereNoindex()
 * @method \Cms\Model\Article\Query\Field andFieldNoindex()
 * @method \Cms\Model\Article\Query\Field orFieldNoindex()
 * @method \Cms\Model\Article\Query\Field orderAscNoindex()
 * @method \Cms\Model\Article\Query\Field orderDescNoindex()
 * @method \Cms\Model\Article\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Article\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Article\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Article\Record[] find()
 * @method \Cms\Model\Article\Record findFirst()
 * @method \Cms\Model\Article\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Article\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
