<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Config\Admin\Navigation;

class Stat extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Statystyki')
				->setModule('cms')
				->setController('admin-stat')
				->addChild(self::newElement()
					->setLabel('Nazwy')
					->setModule('cms')
					->setController('admin-stat')
					->setAction('label')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-stat')
						->setAction('edit')));
	}

}
