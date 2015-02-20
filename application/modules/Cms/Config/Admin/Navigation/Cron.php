<?php


namespace Cms\Config\Admin\Navigation;

class Cron extends \Mmi\Navigation\Config {

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
