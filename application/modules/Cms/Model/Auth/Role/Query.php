<?php

namespace Cms\Model\Auth\Role;

/**
 * @method \Cms\Model\Auth\Role\Query limit($limit = null)
 * @method \Cms\Model\Auth\Role\Query offset($offset = null)
 * @method \Cms\Model\Auth\Role\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Role\Query resetOrder()
 * @method \Cms\Model\Auth\Role\Query resetWhere()
 * @method \Cms\Model\Auth\Role\Query\Field whereId()
 * @method \Cms\Model\Auth\Role\Query\Field andFieldId()
 * @method \Cms\Model\Auth\Role\Query\Field orFieldId()
 * @method \Cms\Model\Auth\Role\Query\Field orderAscId()
 * @method \Cms\Model\Auth\Role\Query\Field orderDescId()
 * @method \Cms\Model\Auth\Role\Query\Field whereCmsAuthId()
 * @method \Cms\Model\Auth\Role\Query\Field andFieldCmsAuthId()
 * @method \Cms\Model\Auth\Role\Query\Field orFieldCmsAuthId()
 * @method \Cms\Model\Auth\Role\Query\Field orderAscCmsAuthId()
 * @method \Cms\Model\Auth\Role\Query\Field orderDescCmsAuthId()
 * @method \Cms\Model\Auth\Role\Query\Field whereCmsRoleId()
 * @method \Cms\Model\Auth\Role\Query\Field andFieldCmsRoleId()
 * @method \Cms\Model\Auth\Role\Query\Field orFieldCmsRoleId()
 * @method \Cms\Model\Auth\Role\Query\Field orderAscCmsRoleId()
 * @method \Cms\Model\Auth\Role\Query\Field orderDescCmsRoleId()
 * @method \Cms\Model\Auth\Role\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Role\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Role\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Role\Record[] find()
 * @method \Cms\Model\Auth\Role\Record findFirst()
 * @method \Cms\Model\Auth\Role\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Auth\Role\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
