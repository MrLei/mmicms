<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
