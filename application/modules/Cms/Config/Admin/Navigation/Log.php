<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
