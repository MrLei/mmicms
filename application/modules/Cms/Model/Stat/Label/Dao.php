<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Stat\Label;

class Dao extends \Mmi\Dao {

	public static $_tableName = 'cms_stat_label';

	/**
	 * 
	 * @param string $object
	 * @return \Cms\Model\Stat\Label\Query
	 */
	public static function byObjectQuery($object) {
		return \Cms\Model\Stat\Label\Query::factory()
				->whereObject()->equals($object);
	}

}
