<?php

class Cms_Model_Tag_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_tag';
	
	public static function byNameQuery($tagName) {
		return Cms_Model_Tag_Query::factory()
				->whereTag()->equals($tagName);
	}

}
