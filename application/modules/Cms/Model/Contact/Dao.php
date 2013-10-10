<?php

class Cms_Model_Contact_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_contact';
	
	public static function findDefaults(array $bind = array(), array $order = array(), $limit = null, $offset = null) {
		if (empty($bind)) {
			$bind = array('active', '1');
		}
		if (empty($order)) {
			$order = array('dateAdd', 'ASC');
		}
		return self::find($bind, $order, $limit, $offset);
	}
	
	public static function countDefaults(array $bind = array()) {
		if (empty($bind)) {
			$bind = array('active', '1');
		}
		return self::count($bind);
	}

}