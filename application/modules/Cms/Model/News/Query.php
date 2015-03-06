<?php

namespace Cms\Model\News;

/**
 * @method \Cms\Model\News\Query limit($limit = null)
 * @method \Cms\Model\News\Query offset($offset = null)
 * @method \Cms\Model\News\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\News\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\News\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\News\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\News\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\News\Query resetOrder()
 * @method \Cms\Model\News\Query resetWhere()
 * @method \Cms\Model\News\Query\Field whereId()
 * @method \Cms\Model\News\Query\Field andFieldId()
 * @method \Cms\Model\News\Query\Field orFieldId()
 * @method \Cms\Model\News\Query\Field orderAscId()
 * @method \Cms\Model\News\Query\Field orderDescId()
 * @method \Cms\Model\News\Query\Field whereLang()
 * @method \Cms\Model\News\Query\Field andFieldLang()
 * @method \Cms\Model\News\Query\Field orFieldLang()
 * @method \Cms\Model\News\Query\Field orderAscLang()
 * @method \Cms\Model\News\Query\Field orderDescLang()
 * @method \Cms\Model\News\Query\Field whereTitle()
 * @method \Cms\Model\News\Query\Field andFieldTitle()
 * @method \Cms\Model\News\Query\Field orFieldTitle()
 * @method \Cms\Model\News\Query\Field orderAscTitle()
 * @method \Cms\Model\News\Query\Field orderDescTitle()
 * @method \Cms\Model\News\Query\Field whereLead()
 * @method \Cms\Model\News\Query\Field andFieldLead()
 * @method \Cms\Model\News\Query\Field orFieldLead()
 * @method \Cms\Model\News\Query\Field orderAscLead()
 * @method \Cms\Model\News\Query\Field orderDescLead()
 * @method \Cms\Model\News\Query\Field whereText()
 * @method \Cms\Model\News\Query\Field andFieldText()
 * @method \Cms\Model\News\Query\Field orFieldText()
 * @method \Cms\Model\News\Query\Field orderAscText()
 * @method \Cms\Model\News\Query\Field orderDescText()
 * @method \Cms\Model\News\Query\Field whereDateAdd()
 * @method \Cms\Model\News\Query\Field andFieldDateAdd()
 * @method \Cms\Model\News\Query\Field orFieldDateAdd()
 * @method \Cms\Model\News\Query\Field orderAscDateAdd()
 * @method \Cms\Model\News\Query\Field orderDescDateAdd()
 * @method \Cms\Model\News\Query\Field whereDateModify()
 * @method \Cms\Model\News\Query\Field andFieldDateModify()
 * @method \Cms\Model\News\Query\Field orFieldDateModify()
 * @method \Cms\Model\News\Query\Field orderAscDateModify()
 * @method \Cms\Model\News\Query\Field orderDescDateModify()
 * @method \Cms\Model\News\Query\Field whereUri()
 * @method \Cms\Model\News\Query\Field andFieldUri()
 * @method \Cms\Model\News\Query\Field orFieldUri()
 * @method \Cms\Model\News\Query\Field orderAscUri()
 * @method \Cms\Model\News\Query\Field orderDescUri()
 * @method \Cms\Model\News\Query\Field whereInternal()
 * @method \Cms\Model\News\Query\Field andFieldInternal()
 * @method \Cms\Model\News\Query\Field orFieldInternal()
 * @method \Cms\Model\News\Query\Field orderAscInternal()
 * @method \Cms\Model\News\Query\Field orderDescInternal()
 * @method \Cms\Model\News\Query\Field whereVisible()
 * @method \Cms\Model\News\Query\Field andFieldVisible()
 * @method \Cms\Model\News\Query\Field orFieldVisible()
 * @method \Cms\Model\News\Query\Field orderAscVisible()
 * @method \Cms\Model\News\Query\Field orderDescVisible()
 * @method \Cms\Model\News\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\News\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\News\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\News\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\News\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\News\Record[] find()
 * @method \Cms\Model\News\Record findFirst()
 * @method \Cms\Model\News\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\News\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
