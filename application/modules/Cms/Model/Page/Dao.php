<?php

class Cms_Model_Page_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_page';
	
	public static function findFirstById($id) {
		$cacheKey = 'Cms_Page_' . $id;
		if (null !== ($record = Default_Registry::$cache->load($cacheKey))) {
			return $record;
		}
		$record = self::activeByIdQuery($id)
			->findFirst();
		Default_Registry::$cache->save($record, $cacheKey, 14400);
		return $record;
	}
	
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