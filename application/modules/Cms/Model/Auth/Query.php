<?php

namespace Cms\Model\Auth;

/**
 * @method \Cms\Model\Auth\Query limit($limit = null)
 * @method \Cms\Model\Auth\Query offset($offset = null)
 * @method \Cms\Model\Auth\Query orderAsc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query orderDesc($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query andQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query whereQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query orQuery(\Mmi\Dao\Query $query)
 * @method \Cms\Model\Auth\Query resetOrder()
 * @method \Cms\Model\Auth\Query resetWhere()
 * @method \Cms\Model\Auth\Query\Field whereId()
 * @method \Cms\Model\Auth\Query\Field andFieldId()
 * @method \Cms\Model\Auth\Query\Field orFieldId()
 * @method \Cms\Model\Auth\Query\Field orderAscId()
 * @method \Cms\Model\Auth\Query\Field orderDescId()
 * @method \Cms\Model\Auth\Query\Field whereLang()
 * @method \Cms\Model\Auth\Query\Field andFieldLang()
 * @method \Cms\Model\Auth\Query\Field orFieldLang()
 * @method \Cms\Model\Auth\Query\Field orderAscLang()
 * @method \Cms\Model\Auth\Query\Field orderDescLang()
 * @method \Cms\Model\Auth\Query\Field whereUsername()
 * @method \Cms\Model\Auth\Query\Field andFieldUsername()
 * @method \Cms\Model\Auth\Query\Field orFieldUsername()
 * @method \Cms\Model\Auth\Query\Field orderAscUsername()
 * @method \Cms\Model\Auth\Query\Field orderDescUsername()
 * @method \Cms\Model\Auth\Query\Field whereEmail()
 * @method \Cms\Model\Auth\Query\Field andFieldEmail()
 * @method \Cms\Model\Auth\Query\Field orFieldEmail()
 * @method \Cms\Model\Auth\Query\Field orderAscEmail()
 * @method \Cms\Model\Auth\Query\Field orderDescEmail()
 * @method \Cms\Model\Auth\Query\Field wherePassword()
 * @method \Cms\Model\Auth\Query\Field andFieldPassword()
 * @method \Cms\Model\Auth\Query\Field orFieldPassword()
 * @method \Cms\Model\Auth\Query\Field orderAscPassword()
 * @method \Cms\Model\Auth\Query\Field orderDescPassword()
 * @method \Cms\Model\Auth\Query\Field whereLastIp()
 * @method \Cms\Model\Auth\Query\Field andFieldLastIp()
 * @method \Cms\Model\Auth\Query\Field orFieldLastIp()
 * @method \Cms\Model\Auth\Query\Field orderAscLastIp()
 * @method \Cms\Model\Auth\Query\Field orderDescLastIp()
 * @method \Cms\Model\Auth\Query\Field whereLastLog()
 * @method \Cms\Model\Auth\Query\Field andFieldLastLog()
 * @method \Cms\Model\Auth\Query\Field orFieldLastLog()
 * @method \Cms\Model\Auth\Query\Field orderAscLastLog()
 * @method \Cms\Model\Auth\Query\Field orderDescLastLog()
 * @method \Cms\Model\Auth\Query\Field whereLastFailIp()
 * @method \Cms\Model\Auth\Query\Field andFieldLastFailIp()
 * @method \Cms\Model\Auth\Query\Field orFieldLastFailIp()
 * @method \Cms\Model\Auth\Query\Field orderAscLastFailIp()
 * @method \Cms\Model\Auth\Query\Field orderDescLastFailIp()
 * @method \Cms\Model\Auth\Query\Field whereLastFailLog()
 * @method \Cms\Model\Auth\Query\Field andFieldLastFailLog()
 * @method \Cms\Model\Auth\Query\Field orFieldLastFailLog()
 * @method \Cms\Model\Auth\Query\Field orderAscLastFailLog()
 * @method \Cms\Model\Auth\Query\Field orderDescLastFailLog()
 * @method \Cms\Model\Auth\Query\Field whereFailLogCount()
 * @method \Cms\Model\Auth\Query\Field andFieldFailLogCount()
 * @method \Cms\Model\Auth\Query\Field orFieldFailLogCount()
 * @method \Cms\Model\Auth\Query\Field orderAscFailLogCount()
 * @method \Cms\Model\Auth\Query\Field orderDescFailLogCount()
 * @method \Cms\Model\Auth\Query\Field whereLogged()
 * @method \Cms\Model\Auth\Query\Field andFieldLogged()
 * @method \Cms\Model\Auth\Query\Field orFieldLogged()
 * @method \Cms\Model\Auth\Query\Field orderAscLogged()
 * @method \Cms\Model\Auth\Query\Field orderDescLogged()
 * @method \Cms\Model\Auth\Query\Field whereActive()
 * @method \Cms\Model\Auth\Query\Field andFieldActive()
 * @method \Cms\Model\Auth\Query\Field orFieldActive()
 * @method \Cms\Model\Auth\Query\Field orderAscActive()
 * @method \Cms\Model\Auth\Query\Field orderDescActive()
 * @method \Cms\Model\Auth\Query\Field andField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Field where($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Field orField($fieldName, $tableName = null)
 * @method \Cms\Model\Auth\Query\Join join($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Query\Join joinLeft($tableName, $targetTableName = null)
 * @method \Cms\Model\Auth\Record[] find()
 * @method \Cms\Model\Auth\Record findFirst()
 * @method \Cms\Model\Auth\Record findPk($value)
 */
class Query extends \Mmi\Dao\Query {

	/**
	 * @return \Cms\Model\Auth\Query
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

}
