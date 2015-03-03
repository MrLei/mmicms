<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Cron;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_cron';

	public static function activeQuery() {
		return \Cms\Model\Cron\Query::factory()
				->whereActive()->equals(1)
				->orderAscId();
	}

}
