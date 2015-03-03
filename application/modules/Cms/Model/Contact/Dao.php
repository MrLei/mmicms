<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
