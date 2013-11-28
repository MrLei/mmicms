<?php

class Cms_Model_Article_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_article';

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->where('uri')->eqals($uri);
		return self::findFirst($q);
	}

}
