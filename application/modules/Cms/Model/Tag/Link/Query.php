<?php

namespace Cms\Model\Tag\Link;

/**
 * @method \Cms\Model\Tag\Link\Query limit($limit = null)
 * @method \Cms\Model\Tag\Link\Query offset($offset = null)
 * @method \Cms\Model\Tag\Link\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Tag\Link\Query resetOrder()
 * @method \Cms\Model\Tag\Link\Query resetWhere()
 * @method \Cms\Model\Tag\Link\Query\Field whereId()
 * @method \Cms\Model\Tag\Link\Query\Field andFieldId()
 * @method \Cms\Model\Tag\Link\Query\Field orFieldId()
 * @method \Cms\Model\Tag\Link\Query\Field orderAscId()
 * @method \Cms\Model\Tag\Link\Query\Field orderDescId()
 * @method \Cms\Model\Tag\Link\Query\Field whereCmsTagId()
 * @method \Cms\Model\Tag\Link\Query\Field andFieldCmsTagId()
 * @method \Cms\Model\Tag\Link\Query\Field orFieldCmsTagId()
 * @method \Cms\Model\Tag\Link\Query\Field orderAscCmsTagId()
 * @method \Cms\Model\Tag\Link\Query\Field orderDescCmsTagId()
 * @method \Cms\Model\Tag\Link\Query\Field whereObject()
 * @method \Cms\Model\Tag\Link\Query\Field andFieldObject()
 * @method \Cms\Model\Tag\Link\Query\Field orFieldObject()
 * @method \Cms\Model\Tag\Link\Query\Field orderAscObject()
 * @method \Cms\Model\Tag\Link\Query\Field orderDescObject()
 * @method \Cms\Model\Tag\Link\Query\Field whereObjectId()
 * @method \Cms\Model\Tag\Link\Query\Field andFieldObjectId()
 * @method \Cms\Model\Tag\Link\Query\Field orFieldObjectId()
 * @method \Cms\Model\Tag\Link\Query\Field orderAscObjectId()
 * @method \Cms\Model\Tag\Link\Query\Field orderDescObjectId()
 * @method \Cms\Model\Tag\Link\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Tag\Link\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Link\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Tag\Link\Record[] find()
 * @method \Cms\Model\Tag\Link\Record findFirst()
 * @method \Cms\Model\Tag\Link\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Tag\Link\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
