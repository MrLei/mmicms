<?php


namespace Cms\Config\Admin\Navigation;

class News extends \Mmi\Navigation\Config {

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
