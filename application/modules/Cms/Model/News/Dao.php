<?php

class Cms_Model_News_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	/**
	 * Zapytanie językowe
	 * @return Cms_Model_News_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Cms_Model_News_Query::factory();
		}
		return Cms_Model_News_Query::factory()
				->andQuery(Cms_Model_News_Query::factory()
					->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}

	/**
	 * Zapytanie o aktywne
	 * @return Cms_Model_News_Query
	 */
	public static function activeQuery() {
		return self::langQuery()
				->whereVisible()->equals(1)
				->orderAscDateAdd();
	}

	/**
	 * Zapytanie o aktywne po uri
	 * @param string $uri
	 * @return Cms_Model_News_Query
	 */
	public static function activeByUriQuery($uri) {
		return self::activeQuery()
				->whereUri()->equals($uri);
	}

	/**
	 * Zapytanie po uri
	 * @param string $uri
	 * @return Cms_Model_News_Query
	 */
	public static function byUriQuery($uri) {
		return self::langQuery()
				->whereUri()->equals($uri);
	}

}
