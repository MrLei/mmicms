<?php

/**
 * @method Cms_Model_Article_Query newQuery() newQuery()
 */
class Cms_Model_Article_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_article';

	/**
	 * 
	 * @param string $uri
	 * @return Cms_Model_Article_Query
	 */
	public static function byUriQuery($uri) {
		return self::newQuery()
				->whereUri()->equals($uri);
	}
	
}
