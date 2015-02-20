<?php

class Cms_Config_Admin_Navigation extends Mmi_Navigation_Config {

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
				->addChild(Cms_Config_Admin_Navigation_Cron::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Log::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Mail::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Navigation::getMenu())
				->addChild(Cms_Config_Admin_Navigation_File::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Route::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Acl::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Auth::getMenu());
	}

	protected static function _getContentPart() {
		return self::newElement()
				->setLabel('CMS treści')
				->setModule('cms')
				->addChild(Cms_Config_Admin_Navigation_News::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Article::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Comment::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Contact::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Stat::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Page::getMenu())
				->addChild(Cms_Config_Admin_Navigation_Text::getMenu());
	}

}
