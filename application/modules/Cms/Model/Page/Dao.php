<?php

class Cms_Model_Page_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_page';
	
	/**
	 * 
	 * @return Cms_Model_Page_Query
	 */
	public static function activeByIdQuery($id) {
		return Cms_Model_Page_Query::factory()
			->whereId()->equals($id)
			->andFieldActive()->equals(true);
	}

}