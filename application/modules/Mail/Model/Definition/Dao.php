<?php

class Mail_Model_Definition_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_definition';

	public static function countLang($q) {
		self::_langQuery($q);
		return self::count($q);
	}

	public static function findLang($q) {
		self::_langQuery($q);
		return parent::find($q);
	}

	public static function findFirstLang($q) {
		self::_langQuery($q);
		return parent::findFirst($q);
	}

	public static function findFirstLangByName($name) {
		$q = self::newQuery()
				->where('name')->equals($name);
		return self::findFirstLang($q);
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
