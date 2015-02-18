<?php

class Cms_Config_Admin_Navigation_Stat extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Statystyki')
				->setModule('cms')
				->setController('admin-stat')
				->addChild(self::newElement()
					->setLabel('Nazwy')
					->setModule('cms')
					->setController('admin-stat')
					->setAction('label')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-stat')
						->setAction('edit')));
	}

}
