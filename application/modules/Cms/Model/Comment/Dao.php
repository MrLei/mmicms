<?php

class Cms_Model_Comment_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_comment';

	public static function findByObject($object, $objectId, $limit = 1000, $offset = 0, $order = 'ASC') {
		return self::find(array(
				array('object', $object),
				array('objectId', $objectId)
				), array(
				array('dateAdd', $order)), $limit, $offset);
	}

	public static function countByObject($object, $objectId) {
		return self::count(array(
				array('object', $object),
				array('objectId', $objectId)
			));
	}

}