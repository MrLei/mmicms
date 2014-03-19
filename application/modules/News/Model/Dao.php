<?php

class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	public static function countActive() {
		$q = self::newQuery()
				->where('visible')->equals(1);
		return self::count($q);
	}

	public static function findActiveWithFile($limit, $offset = null) {
		$q = self::newQuery()
			->where('visible')->equals(1)
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
		$q = self::newQuery()
				->where('visible')->equals(1)
				->andField('uri')->equals($uri);
		return self::findFirst($q);
	}

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->where('uri')->equals($uri);
		return self::findFirst($q);
	}

}
