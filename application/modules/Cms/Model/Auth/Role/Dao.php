<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Auth\Role;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_auth_role';

	public static function byAuthIdQuery($authId) {
		return \Cms\Model\Auth\Role\Query::factory()
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
			$record = new \Cms\Model\Auth\Role\Record();
			$record->cmsAuthId = $cmsAuthId;
			$record->cmsRoleId = $roleId;
			$record->save();
		}
	}

}
