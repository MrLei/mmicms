<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Page;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_page';

	public static function findFirstById($id) {
		$cacheKey = 'Cms-Page-' . $id;
		if (null !== ($record = \Core\Registry::$cache->load($cacheKey))) {
			return $record;
		}
		$record = self::activeByIdQuery($id)
			->findFirst();
		\Core\Registry::$cache->save($record, $cacheKey, 14400);
		return $record;
	}

	/**
	 * 
	 * @return \Cms\Model\Page\Query
	 */
	public static function activeByIdQuery($id) {
		return \Cms\Model\Page\Query::factory()
				->whereId()->equals($id)
				->andFieldActive()->equals(true);
	}

}
