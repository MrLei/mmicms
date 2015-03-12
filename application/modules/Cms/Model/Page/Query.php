<?php

namespace Cms\Model\Page;

/**
 * @method \Cms\Model\Page\Query limit($limit = null)
 * @method \Cms\Model\Page\Query offset($offset = null)
 * @method \Cms\Model\Page\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Query resetOrder()
 * @method \Cms\Model\Page\Query resetWhere()
 * @method \Cms\Model\Page\Query\Field whereId()
 * @method \Cms\Model\Page\Query\Field andFieldId()
 * @method \Cms\Model\Page\Query\Field orFieldId()
 * @method \Cms\Model\Page\Query\Field orderAscId()
 * @method \Cms\Model\Page\Query\Field orderDescId()
 * @method \Cms\Model\Page\Query\Field whereName()
 * @method \Cms\Model\Page\Query\Field andFieldName()
 * @method \Cms\Model\Page\Query\Field orFieldName()
 * @method \Cms\Model\Page\Query\Field orderAscName()
 * @method \Cms\Model\Page\Query\Field orderDescName()
 * @method \Cms\Model\Page\Query\Field whereCmsNavigationId()
 * @method \Cms\Model\Page\Query\Field andFieldCmsNavigationId()
 * @method \Cms\Model\Page\Query\Field orFieldCmsNavigationId()
 * @method \Cms\Model\Page\Query\Field orderAscCmsNavigationId()
 * @method \Cms\Model\Page\Query\Field orderDescCmsNavigationId()
 * @method \Cms\Model\Page\Query\Field whereCmsRouteId()
 * @method \Cms\Model\Page\Query\Field andFieldCmsRouteId()
 * @method \Cms\Model\Page\Query\Field orFieldCmsRouteId()
 * @method \Cms\Model\Page\Query\Field orderAscCmsRouteId()
 * @method \Cms\Model\Page\Query\Field orderDescCmsRouteId()
 * @method \Cms\Model\Page\Query\Field whereText()
 * @method \Cms\Model\Page\Query\Field andFieldText()
 * @method \Cms\Model\Page\Query\Field orFieldText()
 * @method \Cms\Model\Page\Query\Field orderAscText()
 * @method \Cms\Model\Page\Query\Field orderDescText()
 * @method \Cms\Model\Page\Query\Field whereActive()
 * @method \Cms\Model\Page\Query\Field andFieldActive()
 * @method \Cms\Model\Page\Query\Field orFieldActive()
 * @method \Cms\Model\Page\Query\Field orderAscActive()
 * @method \Cms\Model\Page\Query\Field orderDescActive()
 * @method \Cms\Model\Page\Query\Field whereCmsAuthId()
 * @method \Cms\Model\Page\Query\Field andFieldCmsAuthId()
 * @method \Cms\Model\Page\Query\Field orFieldCmsAuthId()
 * @method \Cms\Model\Page\Query\Field orderAscCmsAuthId()
 * @method \Cms\Model\Page\Query\Field orderDescCmsAuthId()
 * @method \Cms\Model\Page\Query\Field whereDateAdd()
 * @method \Cms\Model\Page\Query\Field andFieldDateAdd()
 * @method \Cms\Model\Page\Query\Field orFieldDateAdd()
 * @method \Cms\Model\Page\Query\Field orderAscDateAdd()
 * @method \Cms\Model\Page\Query\Field orderDescDateAdd()
 * @method \Cms\Model\Page\Query\Field whereDateModify()
 * @method \Cms\Model\Page\Query\Field andFieldDateModify()
 * @method \Cms\Model\Page\Query\Field orFieldDateModify()
 * @method \Cms\Model\Page\Query\Field orderAscDateModify()
 * @method \Cms\Model\Page\Query\Field orderDescDateModify()
 * @method \Cms\Model\Page\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Record[] find()
 * @method \Cms\Model\Page\Record findFirst()
 * @method \Cms\Model\Page\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Page\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
