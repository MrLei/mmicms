<?php
class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';
	
	public static function countActive() {
		return self::count(array('visible', 1));
	}
	
	public static function findActiveWithFile($limit, $offset) {
		$data = self::find(array('visible', '1'), array('dateAdd', 'DESC'), $limit, $offset);
		foreach ($data as $key => $row) {
			$data[$key]->file = Cms_Model_File_Dao::findFirstImage('news', $row->id);
		}
		return $data;
	}
	
	public static function findFirstActiveByUri($uri) {
		return self::findFirst(array(
			array('visible', 1),
			array('uri', $uri)
		));
	}
	
}