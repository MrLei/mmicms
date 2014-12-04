<?php

class Cms_Model_Auth_Role_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_auth_role';
	
	public static function byAuthIdQuery($authId) {
		return Cms_Model_Auth_Role_Query::factory()
			->whereCmsAuthId()->equals($authId);
	}

	public static function joinedRolebyAuthId($authId) {
		return self::byAuthIdQuery($authId)
				->join('cms_role')->on('cms_role_id');
	}

	public static function grant($cmsAuthId, array $roles) {
		self::byAuthIdQuery($cmsAuthId)
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
