<?php

class Cms_Model_Auth_Role_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_auth_role';
	protected static $_roleJoinSchema = array('cms_role' => array('id', 'cms_role_id'));

	public static function findPairsRolesByAuthId($authId) {
		$q = self::newQuery()
				->where('cms_auth_id')->eqals($authId)
				->join('cms_role')->on('cms_role_id');
		return self::findPairs('cms_role_id', 'name', $q);
	}

	public static function findRolesIdByAuthId($authId) {
		return self::findPairs('cms_role_id', 'cms_role_id', array('cms_auth_id', $authId));
	}

	public static function grant($cmsAuthId, array $roles) {
		self::find(array('cms_auth_id', $cmsAuthId))->delete();
		foreach ($roles as $roleId) {
			$record = new Cms_Model_Auth_Role_Record();
			$record->cms_auth_id = $cmsAuthId;
			$record->cms_role_id = $roleId;
			$record->save();
		}
	}

}
