<?php

class Cms_Config_Admin_Navigation_Text extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Teksty stałe')
				->setModule('cms')
				->setController('admin-text')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-text')
					->setAction('edit'));
	}

}
