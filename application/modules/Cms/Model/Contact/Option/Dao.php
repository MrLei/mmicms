<?php

class Cms_Model_Contact_Option_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_contact_option';
	
	public static function getMultioptions() {
		return Cms_Model_Contact_Option_Query::factory()
			->orderAsc('name')
			->findPairs('id', 'name');
	}

}
