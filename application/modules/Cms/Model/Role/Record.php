<?php

class Cms_Model_Role_Record extends Mmi_Dao_Record {

	public $id;
	public $name;

	public function save() {
		if (!parent::save()) {
			return false;
		}
		//zapis reguły dostępu do defaulta dla zapisanej roli
		$rule = new Cms_Model_Acl_Record();
		$rule->cmsRoleId = $this->id;
		$rule->module = 'default';
		$rule->access = 'allow';
		return $rule->save();
	}

}
