<?php

class Cms_Config_Admin_Navigation_Contact extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
			->setLabel('Kontakt')
			->setModule('cms')
			->setController('admin-contact')
			->addChild(self::newElement()
				->setLabel('Tematy')
				->setModule('cms')
				->setController('admin-contact')
				->setAction('subject')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-contact')
					->setAction('editSubject')));
	}

}
