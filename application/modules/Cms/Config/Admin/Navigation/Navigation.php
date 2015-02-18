<?php

class Cms_Config_Admin_Navigation_Navigation extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Menu serwisu')
				->setModule('cms')
				->setController('admin-navigation')
				->addChild(self::newElement()
					->setVisible(false)
					->setLabel('Dodaj element menu')
					->setModule('cms')
					->setController('admin-navigation')
					->setAction('edit'));
	}

}
