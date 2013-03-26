<?php

class Cms_Model_Acl_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_acl';
	protected static $_roleJoinSchema = array('cms_role' => array('id', 'cms_role_id'));

	public static function findPairsByRoleId($role) {
		$rules = array();
		$data = Cms_Model_Acl_Dao::find(array('cms_role_id', $role), array(), null, null, self::$_roleJoinSchema);
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
		$aclData = Cms_Model_Acl_Dao::find(array(), array(), null, null, self::$_roleJoinSchema);
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