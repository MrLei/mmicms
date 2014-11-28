<?php

/**
 * @method News_Model_Query newQuery() newQuery() Zapytanie
 */
class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';
	protected static $_queryName = 'News_Model_Query';

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
				->whereVisible()->equals(1);
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findActive($limit, $offset = null) {
		$q = self::newQuery()
			->whereVisible()->equals(1)
			->orderDescDateAdd()
			->limit($limit)
			->offset($offset);
		self::_langQuery($q);
		return self::find($q);
	}

	public static function findFirstActiveByUri($uri) {
		$q = self::newQuery()
			->whereVisible()->equals(1)
			->andFieldUri()->equals($uri);
		self::_langQuery($q);
		return self::findFirst($q);
	}

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->whereUri()->equals($uri);
		self::_langQuery($q);
		return self::findFirst($q);
	}

	protected static function _langQuery(Mmi_Dao_Query $q) {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return $q;
		}
		$subQ = self::newQuery()
			->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
			->orFieldLang()->equals(null)
			->orderDescLang();
		return $q->andQuery($subQ);
	}

}
