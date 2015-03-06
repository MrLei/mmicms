<?php

namespace Cms\Model\Acl;

/**
 * @method \Cms\Model\Acl\Query limit($limit = null)
 * @method \Cms\Model\Acl\Query offset($offset = null)
 * @method \Cms\Model\Acl\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Acl\Query resetOrder()
 * @method \Cms\Model\Acl\Query resetWhere()
 * @method \Cms\Model\Acl\Query\Field whereId()
 * @method \Cms\Model\Acl\Query\Field andFieldId()
 * @method \Cms\Model\Acl\Query\Field orFieldId()
 * @method \Cms\Model\Acl\Query\Field orderAscId()
 * @method \Cms\Model\Acl\Query\Field orderDescId()
 * @method \Cms\Model\Acl\Query\Field whereCmsRoleId()
 * @method \Cms\Model\Acl\Query\Field andFieldCmsRoleId()
 * @method \Cms\Model\Acl\Query\Field orFieldCmsRoleId()
 * @method \Cms\Model\Acl\Query\Field orderAscCmsRoleId()
 * @method \Cms\Model\Acl\Query\Field orderDescCmsRoleId()
 * @method \Cms\Model\Acl\Query\Field whereModule()
 * @method \Cms\Model\Acl\Query\Field andFieldModule()
 * @method \Cms\Model\Acl\Query\Field orFieldModule()
 * @method \Cms\Model\Acl\Query\Field orderAscModule()
 * @method \Cms\Model\Acl\Query\Field orderDescModule()
 * @method \Cms\Model\Acl\Query\Field whereController()
 * @method \Cms\Model\Acl\Query\Field andFieldController()
 * @method \Cms\Model\Acl\Query\Field orFieldController()
 * @method \Cms\Model\Acl\Query\Field orderAscController()
 * @method \Cms\Model\Acl\Query\Field orderDescController()
 * @method \Cms\Model\Acl\Query\Field whereAction()
 * @method \Cms\Model\Acl\Query\Field andFieldAction()
 * @method \Cms\Model\Acl\Query\Field orFieldAction()
 * @method \Cms\Model\Acl\Query\Field orderAscAction()
 * @method \Cms\Model\Acl\Query\Field orderDescAction()
 * @method \Cms\Model\Acl\Query\Field whereAccess()
 * @method \Cms\Model\Acl\Query\Field andFieldAccess()
 * @method \Cms\Model\Acl\Query\Field orFieldAccess()
 * @method \Cms\Model\Acl\Query\Field orderAscAccess()
 * @method \Cms\Model\Acl\Query\Field orderDescAccess()
 * @method \Cms\Model\Acl\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Acl\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Acl\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Acl\Record[] find()
 * @method \Cms\Model\Acl\Record findFirst()
 * @method \Cms\Model\Acl\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Acl\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
