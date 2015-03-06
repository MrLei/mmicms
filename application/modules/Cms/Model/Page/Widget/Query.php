<?php

namespace Cms\Model\Page\Widget;

/**
 * @method \Cms\Model\Page\Widget\Query limit($limit = null)
 * @method \Cms\Model\Page\Widget\Query offset($offset = null)
 * @method \Cms\Model\Page\Widget\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Page\Widget\Query resetOrder()
 * @method \Cms\Model\Page\Widget\Query resetWhere()
 * @method \Cms\Model\Page\Widget\Query\Field whereId()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldId()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldId()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscId()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescId()
 * @method \Cms\Model\Page\Widget\Query\Field whereName()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldName()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldName()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscName()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescName()
 * @method \Cms\Model\Page\Widget\Query\Field whereModule()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldModule()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldModule()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscModule()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescModule()
 * @method \Cms\Model\Page\Widget\Query\Field whereController()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldController()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldController()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscController()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescController()
 * @method \Cms\Model\Page\Widget\Query\Field whereAction()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldAction()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldAction()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscAction()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescAction()
 * @method \Cms\Model\Page\Widget\Query\Field whereParams()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldParams()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldParams()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscParams()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescParams()
 * @method \Cms\Model\Page\Widget\Query\Field whereActive()
 * @method \Cms\Model\Page\Widget\Query\Field andFieldActive()
 * @method \Cms\Model\Page\Widget\Query\Field orFieldActive()
 * @method \Cms\Model\Page\Widget\Query\Field orderAscActive()
 * @method \Cms\Model\Page\Widget\Query\Field orderDescActive()
 * @method \Cms\Model\Page\Widget\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Page\Widget\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Widget\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Page\Widget\Record[] find()
 * @method \Cms\Model\Page\Widget\Record findFirst()
 * @method \Cms\Model\Page\Widget\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Page\Widget\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
