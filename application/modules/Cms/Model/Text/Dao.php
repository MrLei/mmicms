<?php

class Cms_Model_Text_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_text';
	protected static $_texts = array();

	public static function textByKeyLang($key, $lang) {
		if (empty(self::$_texts)) {
			self::_initDictionary();
		}
		if ($lang === null) {
			$lang = 'none';
		}
		if (isset(self::$_texts[$lang][$key])) {
			return self::$_texts[$lang][$key];
		}
		if (isset(self::$_texts['none'][$key])) {
			return self::$_texts['none'][$key];
		}
		return null;
	}

	protected static function _initDictionary() {
		if (null === (self::$_texts = Default_Registry::$cache->load('Cms_Text'))) {
			self::$_texts = array();
			foreach (self::find() as $text) {
				if ($text->lang === null) {
					self::$_texts['none'][$text->key] = $text->content;
					continue;
				}
				self::$_texts[$text->lang][$text->key] = $text->content;
			}
			Default_Registry::$cache->save(self::$_texts, 'Cms_Text', 86400);
		}
	}

}