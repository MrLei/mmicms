<?php


namespace Cms\Model\Contact;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_contact';

	public static function findDefaults(\Mmi\Dao\Query $q) {
		return $q->andField('active')->equals(1)
			->find();
	}

	public static function countDefaults(\Mmi\Dao\Query $q) {
		return $q->andField('active')->equals(1)
			->count();
	}

}
