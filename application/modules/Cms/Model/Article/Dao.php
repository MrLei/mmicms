<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Article;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_article';

	/**
	 * 
	 * @param string $uri
	 * @return \Cms\Model\Article\Query
	 */
	public static function byUriQuery($uri) {
		return \Cms\Model\Article\Query::factory()
				->whereUri()->equals($uri);
	}

	public static function getMultioptions() {
		return array(null => '---') +
				\Cms\Model\Article\Query::factory()
				->orderAscTitle()
				->findPairs('id', 'title');
	}

}
