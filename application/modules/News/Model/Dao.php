<?php
class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';
	
	public static function countActive() {
		$q = self::getNewQuery();
		$q->andField('visible')->eqals(1);
		return self::count($q);
	}
	
	public static function findActiveWithFile($limit, $offset) {
		$q = self::getNewQuery();
		$q->andField('visible')->eqals(1)
				->orderDesc('dateAdd')
				->limit($limit)
				->offset($offset);
		$data = self::find($q);
		foreach ($data as $key => $row) {
			$data[$key]->file = Cms_Model_File_Dao::findFirstImage('news', $row->id);
		}
		return $data;
	}
	
	public static function findFirstActiveByUri($uri) {
		$q = self::getNewQuery();
		$q->andField('visible')->eqals(1)
				->andField('uri')->eqals($uri);
		return self::findFirst($q);
	}
	
}