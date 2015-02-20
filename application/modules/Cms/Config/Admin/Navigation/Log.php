<?php


namespace Cms\Config\Admin\Navigation;

class Log extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Log systemowy')
				->setModule('cms')
				->setController('admin-log')
				->addChild(self::newElement()
					->setLabel('Błedy')
					->setModule('cms')
					->setController('admin-log')
					->setAction('error'));
	}

}
