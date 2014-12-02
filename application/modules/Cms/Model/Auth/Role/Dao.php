<?php

class Cms_Model_Auth_Role_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_auth_role';

	public static function findPairsRolesByAuthId($authId) {
		return Cms_Model_Auth_Role_Query::factory()
				->whereCmsAuthId()->equals($authId)
				->join('cms_role')->on('cms_role_id')
				->findPairs('cms_role_id', 'name');
	}

	public static function findRolesIdByAuthId($authId) {
		return Cms_Model_Auth_Role_Query::factory()
				->whereCmsAuthId()->equals($authId)
				->findPairs('cms_role_id', 'cms_role_id');
	}

	public static function grant($cmsAuthId, array $roles) {
		Cms_Model_Auth_Role_Query::factory()
			->whereCmsAuthId()->equals($cmsAuthId)
			->find()
			->delete();

		foreach ($roles as $roleId) {
			$record = new Cms_Model_Auth_Role_Record();
			$record->cmsAuthId = $cmsAuthId;
			$record->cmsRoleId = $roleId;
			$record->save();
		}
	}

}
