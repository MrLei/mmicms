<?php


namespace Cms\Config\Admin\Navigation;

class Text extends \Mmi\Navigation\Config {

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
