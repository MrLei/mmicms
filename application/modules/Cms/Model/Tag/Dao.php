<?php

class Cms_Model_Tag_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_tag';

	public static function findFirstByName($tagName) {
		$q = self::newQuery()
			->where('tag')->eqals($tagName);
		return self::findFirst($q);
	}

}