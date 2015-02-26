<?php

namespace Cms\Config\Admin\Navigation;

class Navigation extends \Mmi\Navigation\Config {

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
