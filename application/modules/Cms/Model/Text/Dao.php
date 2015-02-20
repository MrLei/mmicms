<?php


namespace Cms\Model\Text;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_text';
	protected static $_texts = array();

	/**
	 * Zapytanie po langu z requesta
	 * @return Cms\Model\Text\Query
	 */
	public static function langQuery() {
		if (!\Mmi\Controller\Front::getInstance()->getRequest()->lang) {
			return Cms\Model\Text\Query::factory();
		}
		return Cms\Model\Text\Query::factory()
				->andQuery(Cms\Model\Text\Query::factory()
					->whereLang()->equals(\Mmi\Controller\Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}
	
	/**
	 * 
	 * @param string $lang
	 * @return Cms\Model\Text\Query
	 */
	public static function byLangQuery($lang) {
		return Cms\Model\Text\Query::factory()
				->whereLang()->equals($lang);
	}
	
	/**
	 * 
	 * @param string $key
	 * @param string $lang
	 * @return Cms\Model\Text\Query
	 */
	public static function byKeyLangQuery($key, $lang) {
		return self::byLangQuery($lang)
				->andFieldKey()->equals($key);
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
		if (null === (self::$_texts = Core\Registry::$cache->load('Cms\Text'))) {
			self::$_texts = array();
			foreach (Cms\Model\Text\Query::factory()->find() as $text) {
				if ($text->lang === null) {
					self::$_texts['none'][$text->key] = $text->content;
					continue;
				}
				self::$_texts[$text->lang][$text->key] = $text->content;
			}
			Core\Registry::$cache->save(self::$_texts, 'Cms\Text', 86400);
		}
	}

}
