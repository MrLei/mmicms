<?php

/**
 * @method News_Model_Query newQuery() newQuery() Nowe zapytanie
 */
class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	/**
	 * 
	 * @return News_Model_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return self::newQuery();
		}
		return self::newQuery()
				->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
				->orFieldLang()->equals(null)
				->orderDescLang();
	}

	/**
	 * 
	 * @return News_Model_Query
	 */
	public static function activeQuery() {
		return self::langQuery()
				->whereVisible()->equals(1)
				->orderAscDateAdd();
	}

	/**
	 * @param string $uri
	 * @return News_Model_Query
	 */
	public static function activeByUriQuery($uri) {
		return self::activeQuery()
				->whereUri()->equals($uri);
	}

	/**
	 * 
	 * @param string $uri
	 * @return News_Model_Query
	 */
	public static function byUriQuery($uri) {
		return self::langQuery()
				->whereUri()->equals($uri);
	}

}
