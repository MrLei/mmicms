<?php

class Cms_Model_Article_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_article';

	/**
	 * 
	 * @param string $uri
	 * @return Cms_Model_Article_Query
	 */
	public static function byUriQuery($uri) {
		return Cms_Model_Article_Query::factory()
				->whereUri()->equals($uri);
	}

	public static function getMultioptions() {
		return array(null => '---') +
				Cms_Model_Article_Query::factory()
				->orderAscTitle()
				->findPairs('id', 'title');
	}

}
