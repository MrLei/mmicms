<?php

/**
 * @method Cms_Model_Auth_Query newQuery() newQuery()
 */
class Cms_Model_Auth_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_auth';

	public static function findFirstByEmail($email) {
		$q = self::newQuery()
				->where('email')->equals($email);
		return self::findFirst($q);
	}

}
