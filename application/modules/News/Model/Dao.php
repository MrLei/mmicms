<?php

class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	public static function countLang($q) {
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findLang($q) {
		self::_langQuery($q);
		return parent::find($q);
	}

	public static function countActive() {
		$q = self::newQuery()
				->where('visible')->equals(1);
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findActive($limit, $offset = null) {
		$q = self::newQuery()
			->where('visible')->equals(1)
			->orderDesc('dateAdd')
			->limit($limit)
			->offset($offset);
		self::_langQuery($q);
		return self::find($q);
	}

	public static function findFirstActiveByUri($uri) {
		$q = self::newQuery()
				->where('visible')->equals(1)
				->andField('uri')->equals($uri);
		self::_langQuery($q);
		return self::findFirst($q);
	}

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->where('uri')->equals($uri);
		self::_langQuery($q);
		return self::findFirst($q);
	}

	protected static function _langQuery(Mmi_Dao_Query $q) {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return $q;
		}
		$subQ = self::newQuery()
			->where('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
			->orField('lang')->equals(null)
			->orderDesc('lang');
		return $q->andQuery($subQ);
	}

}
