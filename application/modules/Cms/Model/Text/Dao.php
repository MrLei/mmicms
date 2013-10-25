<?php

class Cms_Model_Text_Dao extends Mmi_Dao {
	
	protected static $_tableName = 'cms_text';
	protected static $_texts = array();
	
	public static function findByKeyLang($key, $lang) {
		return self::findFirst(array(
			array('key', $key),
			array('lang', $lang),
		));
	}
	
	public static function textByKeyLang($key, $lang) {
		if (empty(self::$_texts)) {
			self::_initDictionary();
		}
		return isset(self::$_texts[$lang][$key]) ? self::$_texts[$lang][$key] : null;
	}
	
	protected static function _initDictionary() {
		if (!(Mmi_Config::$data['cache']['active']) || !(self::$_texts = Mmi_Cache::getInstance()->load('Cms_Text'))) {
			self::$_texts = array();
			foreach (self::find() as $text) {
				self::$_texts[$text->lang][$text->key] = $text->content;
			}
			if (Mmi_Config::$data['cache']['active']) {
				Mmi_Cache::getInstance()->save(self::$_texts, 'Cms_Text', 86400);
			}
		}
	}
	
}