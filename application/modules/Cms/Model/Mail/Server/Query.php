<?php

namespace Cms\Model\Mail\Server;

/**
 * @method \Cms\Model\Mail\Server\Query limit($limit = null)
 * @method \Cms\Model\Mail\Server\Query offset($offset = null)
 * @method \Cms\Model\Mail\Server\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Server\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Server\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Server\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Server\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Mail\Server\Query resetOrder()
 * @method \Cms\Model\Mail\Server\Query resetWhere()
 * @method \Cms\Model\Mail\Server\Query\Field whereId()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldId()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldId()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscId()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescId()
 * @method \Cms\Model\Mail\Server\Query\Field whereAddress()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldAddress()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldAddress()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscAddress()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescAddress()
 * @method \Cms\Model\Mail\Server\Query\Field wherePort()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldPort()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldPort()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscPort()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescPort()
 * @method \Cms\Model\Mail\Server\Query\Field whereUsername()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldUsername()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldUsername()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscUsername()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescUsername()
 * @method \Cms\Model\Mail\Server\Query\Field wherePassword()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldPassword()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldPassword()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscPassword()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescPassword()
 * @method \Cms\Model\Mail\Server\Query\Field whereFrom()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldFrom()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldFrom()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscFrom()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescFrom()
 * @method \Cms\Model\Mail\Server\Query\Field whereDateAdd()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldDateAdd()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldDateAdd()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscDateAdd()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescDateAdd()
 * @method \Cms\Model\Mail\Server\Query\Field whereDateModify()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldDateModify()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldDateModify()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscDateModify()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescDateModify()
 * @method \Cms\Model\Mail\Server\Query\Field whereActive()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldActive()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldActive()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscActive()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescActive()
 * @method \Cms\Model\Mail\Server\Query\Field whereSsl()
 * @method \Cms\Model\Mail\Server\Query\Field andFieldSsl()
 * @method \Cms\Model\Mail\Server\Query\Field orFieldSsl()
 * @method \Cms\Model\Mail\Server\Query\Field orderAscSsl()
 * @method \Cms\Model\Mail\Server\Query\Field orderDescSsl()
 * @method \Cms\Model\Mail\Server\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Server\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Server\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Mail\Server\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Mail\Server\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Mail\Server\Record[] find()
 * @method \Cms\Model\Mail\Server\Record findFirst()
 * @method \Cms\Model\Mail\Server\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Mail\Server\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
