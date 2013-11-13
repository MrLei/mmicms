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
		if (null === (self::$_texts = Default_Registry::$cache->load('Cms_Text'))) {
			self::$_texts = array();
			foreach (self::find() as $text) {
				self::$_texts[$text->lang][$text->key] = $text->content;
			}
			Default_Registry::$cache->save(self::$_texts, 'Cms_Text', 86400);
		}
	}

}