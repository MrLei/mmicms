<?php

class Cms_Model_Route_Dao extends Mmi_Dao {
	
	protected static $_tableName = 'cms_route';
	
	public static function findActive() {
		$texts = array();
		foreach (self::find(array('active', 1), array('order', 'ASC')) as $text) {
			$texts[] = $text->toRouteArray();
		}
		return $texts;
	}	
}