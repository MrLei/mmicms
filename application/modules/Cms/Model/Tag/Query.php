<?php

namespace Cms\Model\Tag;

/**
 * @method \Cms\Model\Tag\Query limit($limit = null)
 * @method \Cms\Model\Tag\Query offset($offset = null)
 * @method \Cms\Model\Tag\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Query resetOrder()
 * @method \Cms\Model\Tag\Query resetWhere()
 * @method \Cms\Model\Tag\Query\Field whereId()
 * @method \Cms\Model\Tag\Query\Field andFieldId()
 * @method \Cms\Model\Tag\Query\Field orFieldId()
 * @method \Cms\Model\Tag\Query\Field orderAscId()
 * @method \Cms\Model\Tag\Query\Field orderDescId()
 * @method \Cms\Model\Tag\Query\Field whereTag()
 * @method \Cms\Model\Tag\Query\Field andFieldTag()
 * @method \Cms\Model\Tag\Query\Field orFieldTag()
 * @method \Cms\Model\Tag\Query\Field orderAscTag()
 * @method \Cms\Model\Tag\Query\Field orderDescTag()
 * @method \Cms\Model\Tag\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Record[] find()
 * @method \Cms\Model\Tag\Record findFirst()
 * @method \Cms\Model\Tag\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Tag\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
