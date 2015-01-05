<?php

class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	/**
	 * Zapytanie językowe
	 * @return News_Model_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return News_Model_Query::factory();
		}
		return News_Model_Query::factory()
				->andQuery(News_Model_Query::factory()
					->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}

	/**
	 * Zapytanie o aktywne
	 * @return News_Model_Query
	 */
	public static function activeQuery() {
		return self::langQuery()
				->whereVisible()->equals(1)
				->orderAscDateAdd();
	}

	/**
	 * Zapytanie o aktywne po uri
	 * @param string $uri
	 * @return News_Model_Query
	 */
	public static function activeByUriQuery($uri) {
		return self::activeQuery()
				->whereUri()->equals($uri);
	}

	/**
	 * Zapytanie po uri
	 * @param string $uri
	 * @return News_Model_Query
	 */
	public static function byUriQuery($uri) {
		return self::langQuery()
				->whereUri()->equals($uri);
	}
	
}
