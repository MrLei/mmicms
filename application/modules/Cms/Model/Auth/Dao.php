<?php

class Cms_Model_Auth_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_auth';

	public static function findFirstByEmail($email) {
		return Cms_Model_Auth_Query::factory()
			->whereEmail()->equals($email)
			->findFirst();
	}

}
