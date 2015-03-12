<?php

namespace Cms\Model\Navigation;

/**
 * @method \Cms\Model\Navigation\Query limit($limit = null)
 * @method \Cms\Model\Navigation\Query offset($offset = null)
 * @method \Cms\Model\Navigation\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Navigation\Query resetOrder()
 * @method \Cms\Model\Navigation\Query resetWhere()
 * @method \Cms\Model\Navigation\Query\Field whereId()
 * @method \Cms\Model\Navigation\Query\Field andFieldId()
 * @method \Cms\Model\Navigation\Query\Field orFieldId()
 * @method \Cms\Model\Navigation\Query\Field orderAscId()
 * @method \Cms\Model\Navigation\Query\Field orderDescId()
 * @method \Cms\Model\Navigation\Query\Field whereLang()
 * @method \Cms\Model\Navigation\Query\Field andFieldLang()
 * @method \Cms\Model\Navigation\Query\Field orFieldLang()
 * @method \Cms\Model\Navigation\Query\Field orderAscLang()
 * @method \Cms\Model\Navigation\Query\Field orderDescLang()
 * @method \Cms\Model\Navigation\Query\Field whereParentId()
 * @method \Cms\Model\Navigation\Query\Field andFieldParentId()
 * @method \Cms\Model\Navigation\Query\Field orFieldParentId()
 * @method \Cms\Model\Navigation\Query\Field orderAscParentId()
 * @method \Cms\Model\Navigation\Query\Field orderDescParentId()
 * @method \Cms\Model\Navigation\Query\Field whereOrder()
 * @method \Cms\Model\Navigation\Query\Field andFieldOrder()
 * @method \Cms\Model\Navigation\Query\Field orFieldOrder()
 * @method \Cms\Model\Navigation\Query\Field orderAscOrder()
 * @method \Cms\Model\Navigation\Query\Field orderDescOrder()
 * @method \Cms\Model\Navigation\Query\Field whereModule()
 * @method \Cms\Model\Navigation\Query\Field andFieldModule()
 * @method \Cms\Model\Navigation\Query\Field orFieldModule()
 * @method \Cms\Model\Navigation\Query\Field orderAscModule()
 * @method \Cms\Model\Navigation\Query\Field orderDescModule()
 * @method \Cms\Model\Navigation\Query\Field whereController()
 * @method \Cms\Model\Navigation\Query\Field andFieldController()
 * @method \Cms\Model\Navigation\Query\Field orFieldController()
 * @method \Cms\Model\Navigation\Query\Field orderAscController()
 * @method \Cms\Model\Navigation\Query\Field orderDescController()
 * @method \Cms\Model\Navigation\Query\Field whereAction()
 * @method \Cms\Model\Navigation\Query\Field andFieldAction()
 * @method \Cms\Model\Navigation\Query\Field orFieldAction()
 * @method \Cms\Model\Navigation\Query\Field orderAscAction()
 * @method \Cms\Model\Navigation\Query\Field orderDescAction()
 * @method \Cms\Model\Navigation\Query\Field whereParams()
 * @method \Cms\Model\Navigation\Query\Field andFieldParams()
 * @method \Cms\Model\Navigation\Query\Field orFieldParams()
 * @method \Cms\Model\Navigation\Query\Field orderAscParams()
 * @method \Cms\Model\Navigation\Query\Field orderDescParams()
 * @method \Cms\Model\Navigation\Query\Field whereLabel()
 * @method \Cms\Model\Navigation\Query\Field andFieldLabel()
 * @method \Cms\Model\Navigation\Query\Field orFieldLabel()
 * @method \Cms\Model\Navigation\Query\Field orderAscLabel()
 * @method \Cms\Model\Navigation\Query\Field orderDescLabel()
 * @method \Cms\Model\Navigation\Query\Field whereTitle()
 * @method \Cms\Model\Navigation\Query\Field andFieldTitle()
 * @method \Cms\Model\Navigation\Query\Field orFieldTitle()
 * @method \Cms\Model\Navigation\Query\Field orderAscTitle()
 * @method \Cms\Model\Navigation\Query\Field orderDescTitle()
 * @method \Cms\Model\Navigation\Query\Field whereKeywords()
 * @method \Cms\Model\Navigation\Query\Field andFieldKeywords()
 * @method \Cms\Model\Navigation\Query\Field orFieldKeywords()
 * @method \Cms\Model\Navigation\Query\Field orderAscKeywords()
 * @method \Cms\Model\Navigation\Query\Field orderDescKeywords()
 * @method \Cms\Model\Navigation\Query\Field whereDescription()
 * @method \Cms\Model\Navigation\Query\Field andFieldDescription()
 * @method \Cms\Model\Navigation\Query\Field orFieldDescription()
 * @method \Cms\Model\Navigation\Query\Field orderAscDescription()
 * @method \Cms\Model\Navigation\Query\Field orderDescDescription()
 * @method \Cms\Model\Navigation\Query\Field whereUri()
 * @method \Cms\Model\Navigation\Query\Field andFieldUri()
 * @method \Cms\Model\Navigation\Query\Field orFieldUri()
 * @method \Cms\Model\Navigation\Query\Field orderAscUri()
 * @method \Cms\Model\Navigation\Query\Field orderDescUri()
 * @method \Cms\Model\Navigation\Query\Field whereVisible()
 * @method \Cms\Model\Navigation\Query\Field andFieldVisible()
 * @method \Cms\Model\Navigation\Query\Field orFieldVisible()
 * @method \Cms\Model\Navigation\Query\Field orderAscVisible()
 * @method \Cms\Model\Navigation\Query\Field orderDescVisible()
 * @method \Cms\Model\Navigation\Query\Field whereHttps()
 * @method \Cms\Model\Navigation\Query\Field andFieldHttps()
 * @method \Cms\Model\Navigation\Query\Field orFieldHttps()
 * @method \Cms\Model\Navigation\Query\Field orderAscHttps()
 * @method \Cms\Model\Navigation\Query\Field orderDescHttps()
 * @method \Cms\Model\Navigation\Query\Field whereAbsolute()
 * @method \Cms\Model\Navigation\Query\Field andFieldAbsolute()
 * @method \Cms\Model\Navigation\Query\Field orFieldAbsolute()
 * @method \Cms\Model\Navigation\Query\Field orderAscAbsolute()
 * @method \Cms\Model\Navigation\Query\Field orderDescAbsolute()
 * @method \Cms\Model\Navigation\Query\Field whereIndependent()
 * @method \Cms\Model\Navigation\Query\Field andFieldIndependent()
 * @method \Cms\Model\Navigation\Query\Field orFieldIndependent()
 * @method \Cms\Model\Navigation\Query\Field orderAscIndependent()
 * @method \Cms\Model\Navigation\Query\Field orderDescIndependent()
 * @method \Cms\Model\Navigation\Query\Field whereNofollow()
 * @method \Cms\Model\Navigation\Query\Field andFieldNofollow()
 * @method \Cms\Model\Navigation\Query\Field orFieldNofollow()
 * @method \Cms\Model\Navigation\Query\Field orderAscNofollow()
 * @method \Cms\Model\Navigation\Query\Field orderDescNofollow()
 * @method \Cms\Model\Navigation\Query\Field whereBlank()
 * @method \Cms\Model\Navigation\Query\Field andFieldBlank()
 * @method \Cms\Model\Navigation\Query\Field orFieldBlank()
 * @method \Cms\Model\Navigation\Query\Field orderAscBlank()
 * @method \Cms\Model\Navigation\Query\Field orderDescBlank()
 * @method \Cms\Model\Navigation\Query\Field whereDateStart()
 * @method \Cms\Model\Navigation\Query\Field andFieldDateStart()
 * @method \Cms\Model\Navigation\Query\Field orFieldDateStart()
 * @method \Cms\Model\Navigation\Query\Field orderAscDateStart()
 * @method \Cms\Model\Navigation\Query\Field orderDescDateStart()
 * @method \Cms\Model\Navigation\Query\Field whereDateEnd()
 * @method \Cms\Model\Navigation\Query\Field andFieldDateEnd()
 * @method \Cms\Model\Navigation\Query\Field orFieldDateEnd()
 * @method \Cms\Model\Navigation\Query\Field orderAscDateEnd()
 * @method \Cms\Model\Navigation\Query\Field orderDescDateEnd()
 * @method \Cms\Model\Navigation\Query\Field whereActive()
 * @method \Cms\Model\Navigation\Query\Field andFieldActive()
 * @method \Cms\Model\Navigation\Query\Field orFieldActive()
 * @method \Cms\Model\Navigation\Query\Field orderAscActive()
 * @method \Cms\Model\Navigation\Query\Field orderDescActive()
 * @method \Cms\Model\Navigation\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Navigation\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Navigation\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Navigation\Record[] find()
 * @method \Cms\Model\Navigation\Record findFirst()
 * @method \Cms\Model\Navigation\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Navigation\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
