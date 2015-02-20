<?php


namespace Cms\Model\Cron;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_cron';

	public static function activeQuery() {
		return Cms\Model\Cron\Query::factory()
			->whereActive()->equals(1)
			->orderAscId();
	}

}
