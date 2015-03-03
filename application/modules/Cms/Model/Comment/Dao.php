<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Comment;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_comment';

	public static function byObjectQuery($object, $objectId, $descending = false) {
		$q = \Cms\Model\Comment\Query::factory()
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId);
		if ($descending) {
			$q->orderDesc('dateAdd');
		} else {
			$q->orderAsc('dateAdd');
		}
		return $q;
	}

}
