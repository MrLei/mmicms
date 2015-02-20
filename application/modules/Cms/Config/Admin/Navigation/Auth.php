<?php

class Cms_Config_Admin_Navigation_Auth extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Użytkownicy')
				->setModule('cms')
				->setController('admin-auth')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-auth')
					->setAction('edit')
		);
	}

}
