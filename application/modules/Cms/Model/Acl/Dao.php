<?php

class Cms_Model_Acl_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_acl';

	public static function getMultioptionsByRoleId($role) {
		$rules = array();
		$data = Cms_Model_Acl_Query::factory()
			->whereCmsRoleId()->equals($role)
			->find();
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
		$aclData = Cms_Model_Acl_Query::factory()
			->join('cms_role')->on('cms_role_id')
			->find();
		foreach ($aclData as $aclRule) { /* @var $aclData Cms_Model_Acl_Record */
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
				$acl->$access($aclRule->getJoined('cms_role')->name, trim($resource, ':'));
			}
		}
		return $acl;
	}

}
