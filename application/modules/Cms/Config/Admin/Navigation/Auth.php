<?php

namespace Cms\Config\Admin\Navigation;

class Auth extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Użytkownicy')
				->setModule('cms')
				->setController('admin-auth')
				->addChild(self::newElement()
					->setLabel('Dodaj')
					->setModule('cms')
					->setController('admin-auth')
					->setAction('edit')
		);
	}

}
