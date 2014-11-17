<?php

class Cms_Model_Container_Template_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template';
	
	public static function findFirstByName($name) {
		$q = self::newQuery()
			->where('name')->equals($name);
		return self::findFirst($q);
	}

}