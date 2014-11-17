<?php

class Cms_Model_Role_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $name;
	
	public function save() {
		$this->name = $this->role;
		if (!parent::save()) {
			return false;
		}
		//zapis reguły dostępu do defaulta dla zapisanej roli
		$rule = new Cms_Model_Acl_Record();
		$rule->cms_role_id = $this->id;
		$rule->module = 'default';
		$rule->access = 'allow';
		return $rule->save();
	}

}