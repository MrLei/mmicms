<?php

class Cms_Config_Admin_Navigation_Log extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Log systemowy')
				->setModule('cms')
				->setController('admin-log')
				->addChild(self::newElement()
					->setLabel('Błedy')
					->setModule('cms')
					->setController('admin-log')
					->setAction('error'));
	}

}
