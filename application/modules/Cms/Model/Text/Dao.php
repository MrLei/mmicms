<?php

/**
 * @method Cms_Model_Text_Query newQuery() newQuery()
 */
class Cms_Model_Text_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_text';
	protected static $_texts = array();

	public static function findByLang($lang) {
		$q = self::newQuery()
				->where('lang')->equals($lang);
		return self::find($q);
	}

	public static function findFirstByKeyLang($key, $lang) {
		$q = self::newQuery()
				->where('lang')->equals($lang)
				->andField('key')->equals($key);
		return self::findFirst($q);
	}

	public static function countLang($q) {
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findLang($q) {
		self::_langQuery($q);
		return parent::find($q);
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

	protected static function _langQuery(Mmi_Dao_Query $q) {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return $q;
		}
		$subQ = self::newQuery()
			->where('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
			->orField('lang')->equals(null)
			->orderDesc('lang');
		return $q->andQuery($subQ);
	}

}
