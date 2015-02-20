<?php

class Cms_Config_Admin_Navigation_Route extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Routing')
				->setModule('cms')
				->setController('admin-route')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-route')
					->setAction('edit')
		);
	}

}
