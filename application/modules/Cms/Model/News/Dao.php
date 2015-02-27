<?php

namespace Cms\Model\News;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_news';

	/**
	 * Zapytanie językowe
	 * @return \Cms\Model\News\Query
	 */
	public static function langQuery() {
		if (!\Mmi\Controller\Front::getInstance()->getRequest()->lang) {
			return \Cms\Model\News\Query::factory();
		}
		return \Cms\Model\News\Query::factory()
				->andQuery(\Cms\Model\News\Query::factory()
					->whereLang()->equals(\Mmi\Controller\Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}

	/**
	 * Zapytanie o aktywne
	 * @return \Cms\Model\News\Query
	 */
	public static function activeQuery() {
		return self::langQuery()
				->whereVisible()->equals(1)
				->orderAscDateAdd();
	}

	/**
	 * Zapytanie o aktywne po uri
	 * @param string $uri
	 * @return \Cms\Model\News\Query
	 */
	public static function activeByUriQuery($uri) {
		return self::activeQuery()
				->whereUri()->equals($uri);
	}

	/**
	 * Zapytanie po uri
	 * @param string $uri
	 * @return \Cms\Model\News\Query
	 */
	public static function byUriQuery($uri) {
		return self::langQuery()
				->whereUri()->equals($uri);
	}

}
