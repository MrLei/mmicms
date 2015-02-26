<?php

namespace Cms\Config\Admin\Navigation;

class Article extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Artykuły')
				->setModule('cms')
				->setController('admin-article')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-article')
					->setAction('edit'));
	}

}
