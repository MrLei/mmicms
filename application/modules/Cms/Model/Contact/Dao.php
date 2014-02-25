<?php

class Cms_Model_Contact_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_contact';
	
	public static function findDefaults(Mmi_Dao_Query $q) {
		$q->andField('active')->eqals(1);
		return self::find($q);
	}
	
	public static function countDefaults(Mmi_Dao_Query $q) {
		$q->andField('active')->eqals(1);
		return self::count($q);
	}

}