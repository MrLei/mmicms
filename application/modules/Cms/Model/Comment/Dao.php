<?php


namespace Cms\Model\Comment;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_comment';

	public static function byObjectQuery($object, $objectId, $descending = false) {
		$q = Cms\Model\Comment\Query::factory()
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
