<?php

class Cms_Model_Comment_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_comment';

	public static function findByObject($object, $objectId, $descending = false) {
		$q = Cms_Model_Comment_Query::factory()
			->whereObject()->equals($object)
			->andFieldObjectId()->equals($objectId)
			->limit(100);

		if ($descending) {
			$q->orderDesc('dateAdd');
		} else {
			$q->orderAsc('dateAdd');
		}
		return $q->find();
	}

	public static function countByObject($object, $objectId) {
		return Cms_Model_Comment_Query::factory()
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId)
				->count();
	}

}
