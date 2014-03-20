<?php

class News_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'news';

	public static function countActive() {
		$q = self::newQuery()
				->where('visible')->equals(1);
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$q->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return self::count($q);
	}
	
	public static function countLang($bind) {
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$bind->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return self::count($bind);
	}
	
	public static function findLang($bind) {
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$bind->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return parent::find($bind);
	}

	public static function findActive($limit, $offset = null) {
		$q = self::newQuery()
			->where('visible')->equals(1)
			->orderDesc('dateAdd')
			->limit($limit)
			->offset($offset);
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$q->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return self::find($q);
	}

	public static function findFirstActiveByUri($uri) {
		$q = self::newQuery()
				->where('visible')->equals(1)
				->andField('uri')->equals($uri);
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$q->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return self::findFirst($q);
	}

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->where('uri')->equals($uri);
		if (Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			$q->andField('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		}
		return self::findFirst($q);
	}

}
