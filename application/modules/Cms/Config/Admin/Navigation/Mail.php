<?php


namespace Cms\Config\Admin\Navigation;

class Mail extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('System mailowy')
				->setModule('cms')
				->setController('admin-mail')
				->addChild(self::newElement()
					->setLabel('Wyślij z kolejki')
					->setModule('cms')
					->setController('admin-mail')
					->setAction('send'))
				->addChild(self::newElement()
					->setLabel('Szablony')
					->setModule('cms')
					->setController('admin-mailDefinition')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-mailDefinition')
						->setAction('edit')))
				->addChild(self::newElement()
					->setLabel('Serwery')
					->setModule('cms')
					->setController('admin-mailServer')
					->addChild(self::newElement()
						->setLabel('Dodaj')
						->setModule('cms')
						->setController('admin-mailServer')
						->setAction('edit')));
	}

}
