<?php

class Cms_Model_Tag_Link_Dao extends Mmi_Dao {
	
	protected static $_tableName = 'cms_tag_link';
	
	public static function link($objectId, array $tags, $objectType) {
		self::find(array(array('objectId', $objectId), array('object', $objectType)))->delete();
		foreach ($tags as $tagId) {
			$record = new Cms_Model_Tag_Link_Record();
			$record->cms_tag_id = $tagId;
			$record->objectId = $objectId;
			$record->object = $objectType;
			$record->save();
		}
	}
	
	public static function unlink($objectId, $objectType) {
		self::find(array(array('objectId', $objectId), array('object', $objectType)))->delete();
	}
}