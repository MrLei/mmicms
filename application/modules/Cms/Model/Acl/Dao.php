<?php

class Cms_Model_Acl_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_acl';

	public static function findPairsByRoleId($role) {
		$rules = array();

		$q = self::newQuery()
				->where('cms_role_id')->eqals($role);

		$data = Cms_Model_Acl_Dao::find($q);
		foreach ($data as $item) {
			if ($item->action) {
				$rules[$item->module . ':' . $item->controller . ':' . $item->action] = $item;
			} elseif ($item->controller) {
				$rules[$item->module . ':' . $item->controller] = $item;
			} else {
				$rules[$item->module] = $item;
			}
		}
		return $rules;
	}

	public static function setupAcl() {
		$acl = new Mmi_Acl();
		$q = self::newQuery()
				->join('cms_role')->on('cms_role_id');
		$aclData = Cms_Model_Acl_Dao::find($q);
		foreach ($aclData as $aclRule) {
			$resource = '';
			if ($aclRule->module) {
				$resource .= $aclRule->module . ':';
			}
			if ($aclRule->controller) {
				$resource .= $aclRule->controller . ':';
			}
			if ($aclRule->action) {
				$resource .= $aclRule->action . ':';
			}
			$access = $aclRule->access;
			if ($access == 'allow' || $access == 'deny') {
				$acl->$access($aclRule->cms_role->name, trim($resource, ':'));
			}
		}
		return $acl;
	}

}
