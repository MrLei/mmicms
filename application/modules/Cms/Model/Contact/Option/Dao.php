<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Contact\Option;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_contact_option';

	public static function getMultioptions() {
		return \Cms\Model\Contact\Option\Query::factory()
				->orderAsc('name')
				->findPairs('id', 'name');
	}

}
