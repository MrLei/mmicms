<?php

class Cms_Config_Admin_Navigation_Cron extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Cron')
				->setModule('cms')
				->setController('admin-cron')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-cron')
					->setAction('edit'));
	}

}
