<?php

class Mail_Model_Definition_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_definition';

	public static function countLang(Mmi_Dao_Query $q) {
		return self::langQuery()
			->andQuery($q)
			->count();
	}

	public static function findLang(Mmi_Dao_Query $q) {
		return self::langQuery()
			->andQuery($q)
			->find();
	}

	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Mail_Model_Definition_Query::factory();
		}
		return Mail_Model_Definition_Query::factory()
			->andQuery(Mail_Model_Definition_Query::factory()
				->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
				->orFieldLang()->equals(null)
				->orderDescLang()
		);
	}

	public static function findFirstLang(Mmi_Dao_Query $q) {
		return self::langQuery()
			->andQuery($q)
			->findFirst();
	}

	public static function findFirstLangByName($name) {
		$q = Mail_Model_Definition_Query::factory()
				->whereName()->equals($name);
		return self::findFirstLang($q);
	}

}
