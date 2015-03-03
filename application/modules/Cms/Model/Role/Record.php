<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
