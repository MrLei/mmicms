<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Config\Admin\Navigation;

class Contact extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Kontakt')
				->setModule('cms')
				->setController('admin-contact')
				->addChild(self::newElement()
					->setLabel('Tematy')
					->setModule('cms')
					->setController('admin-contact')
					->setAction('subject')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-contact')
						->setAction('editSubject')));
	}

}
