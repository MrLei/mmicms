<?php

class Cms_Config_Admin_Navigation_Acl extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Uprawnienia')
				->setModule('cms')
				->setController('admin-acl');
	}

}
