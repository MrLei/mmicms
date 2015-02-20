<?php


namespace Cms\Config\Admin;

class Navigation extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Panel administracyjny')
				->setModule('cms')
				->setController('admin')
				->setVisible(true)
				->addChild(self::newElement()
					->setLabel('Zmiana hasła')
					->setModule('cms')
					->setController('admin')
					->setAction('password')
					->setVisible(false)
				)
				->addChild(self::_getAdminPart())
				->addChild(self::_getContentPart());
	}

	protected static function _getAdminPart() {
		return self::newElement()
				->setLabel('CMS Administracja')
				->setModule('cms')
				->setController('admin')
				->addChild(Navigation\Cron::getMenu())
				->addChild(Navigation\Log::getMenu())
				->addChild(Navigation\Mail::getMenu())
				->addChild(Navigation\Navigation::getMenu())
				->addChild(Navigation\File::getMenu())
				->addChild(Navigation\Route::getMenu())
				->addChild(Navigation\Acl::getMenu())
				->addChild(Navigation\Auth::getMenu());
	}

	protected static function _getContentPart() {
		return self::newElement()
				->setLabel('CMS treści')
				->setModule('cms')
				->addChild(Navigation\News::getMenu())
				->addChild(Navigation\Article::getMenu())
				->addChild(Navigation\Comment::getMenu())
				->addChild(Navigation\Contact::getMenu())
				->addChild(Navigation\Stat::getMenu())
				->addChild(Navigation\Page::getMenu())
				->addChild(Navigation\Text::getMenu());
	}

}
