<?php


namespace Cms\Config\Admin\Navigation;

class Route extends \Mmi\Navigation\Config {

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
