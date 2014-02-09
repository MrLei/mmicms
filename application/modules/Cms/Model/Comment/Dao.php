<?php

class Cms_Model_Comment_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_comment';

	public static function findByObject($object, $objectId, $descending = false) {
		$q = self::newQuery()
			->where('object')->eqals($object)
			->andField('objectId')->eqals($objectId)
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
				->where('object')->eqals($object)
				->andField('objectId')->eqals($objectId);
		return self::count($q);
	}

}
