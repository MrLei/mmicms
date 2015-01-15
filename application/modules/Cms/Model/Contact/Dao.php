<?php

class Cms_Model_Contact_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_contact';

	public static function findDefaults(Mmi_Dao_Query $q) {
		return $q->andField('active')->equals(1)
			->find();
	}

	public static function countDefaults(Mmi_Dao_Query $q) {
		return $q->andField('active')->equals(1)
			->count();
	}

}
