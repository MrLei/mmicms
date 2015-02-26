<?php

namespace Cms\Config\Admin\Navigation;

class Page extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Strony CMS')
				->setModule('cms')
				->setController('admin-page')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-page')
					->setAction('edit'))
				->addChild(self::newElement()
					->setLabel('Widgety')
					->setModule('cms')
					->setController('admin-widget'))
				->addChild(self::newElement()
					->setLabel('Widgety - deklaracja')
					->setModule('cms')
					->setController('admin-pageWidget')
					->setAction('index')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-pageWidget')
						->setAction('edit')));
	}

}
