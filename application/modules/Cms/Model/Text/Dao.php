<?php

class Cms_Model_Text_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_text';
	protected static $_texts = array();

	/**
	 * Zapytanie po langu z requesta
	 * @return Cms_Model_Text_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Cms_Model_Text_Query::factory();
		}
		return Cms_Model_Text_Query::factory()
				->andQuery(Cms_Model_Text_Query::factory()
					->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}
	
	/**
	 * 
	 * @param string $lang
	 * @return Cms_Model_Text_Query
	 */
	public static function byLangQuery($lang) {
		return Cms_Model_Text_Query::factory()
				->whereLang()->equals($lang);
	}

	public static function findFirstByKeyLang($key, $lang) {
		return self::byLangQuery($lang)
				->andFieldKey()->equals($key)
				->findFirst();
	}

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
			foreach (Cms_Model_Text_Query::factory()->find() as $text) {
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
