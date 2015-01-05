<?php

class Cms_Model_Comment_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_comment';

	public static function byObjectQuery($object, $objectId, $descending = false) {
		$q = Cms_Model_Comment_Query::factory()
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
