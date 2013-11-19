<?php

class Cms_Model_Acl_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_acl';

	public static function findPairsByRoleId($role) {
		$rules = array();

		$q = self::getNewQuery();
		$q->andField('cms_role_id')->eqals($role)
			->join('cms_role')->on('cms_role_id');

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
		$q = self::getNewQuery();
		$q->join('cms_role')->on('cms_role_id');
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
			$resource = trim($resource, ':');
			$access = $aclRule->access;
			if ($access == 'allow' || $access == 'deny') {
				$acl->$access($aclRule->name, $resource);
			}
		}
		return $acl;
	}

}