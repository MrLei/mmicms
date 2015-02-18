<?php

class Cms_Config_Admin_Navigation_News extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
					->setLabel('Aktualności')
					->setModule('cms')
					->setController('admin-news')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-news')
						->setAction('edit'));
	}

}
