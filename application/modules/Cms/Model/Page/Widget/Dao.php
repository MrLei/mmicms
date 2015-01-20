<?php

class Cms_Model_Page_Widget_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_page_widget';
	
	public static function activeQuery() {
		return Cms_Model_Page_Widget_Query::factory()
			->whereActive()->equals(true);
	}
	
}