<?php


namespace Cms\Model\Contact\Option;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_contact_option';
	
	public static function getMultioptions() {
		return Cms\Model\Contact\Option\Query::factory()
			->orderAsc('name')
			->findPairs('id', 'name');
	}

}
