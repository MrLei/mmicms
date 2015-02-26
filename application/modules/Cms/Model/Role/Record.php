<?php

namespace Cms\Model\Role;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $name;

	public function save() {
		if (!parent::save()) {
			return false;
		}
		//zapis reguły dostępu do defaulta dla zapisanej roli
		$rule = new \Cms\Model\Acl\Record();
		$rule->cmsRoleId = $this->id;
		$rule->module = 'default';
		$rule->access = 'allow';
		return $rule->save();
	}

}
