<?php

class Cms_Model_Text_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_text';
	protected static $_texts = array();

	public static function findByLang($lang) {
		return Cms_Model_Text_Query::factory()
				->whereLang()->equals($lang)
				->find();
	}

	public static function findFirstByKeyLang($key, $lang) {
		return Cms_Model_Text_Query::factory()
				->whereLang()->equals($lang)
				->andFieldKey()->equals($key)
				->findFirst();
	}

	public static function countLang($q) {
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findLang($q) {
		return self::_langQuery($q)
				->find();
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

	protected static function _langQuery(Mmi_Dao_Query $q) {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return $q;
		}
		$subQ = Cms_Model_Text_Query::factory()
			->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
			->orFieldLang()->equals(null)
			->orderDescLang();
		return $q->andQuery($subQ);
	}

}
