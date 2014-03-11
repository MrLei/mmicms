<?php

class Cms_Model_Comment_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_comment';

	public static function findByObject($object, $objectId, $descending = false) {
		$q = self::newQuery()
			->where('object')->equals($object)
			->andField('objectId')->equals($objectId)
			->limit(100);

		if ($descending) {
			$q->orderDesc('dateAdd');
		} else {
			$q->orderAsc('dateAdd');
		}
		return self::find($q);
	}

	public static function countByObject($object, $objectId) {
		$q = self::newQuery()
				->where('object')->equals($object)
				->andField('objectId')->equals($objectId);
		return self::count($q);
	}

}
