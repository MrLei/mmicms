<?php

class Cms_Config_Admin_Navigation_Article extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Artykuły')
				->setModule('cms')
				->setController('admin-article')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-article')
					->setAction('edit'));
	}

}
