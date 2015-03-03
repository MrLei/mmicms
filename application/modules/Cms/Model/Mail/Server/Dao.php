<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Mail\Server;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_mail_server';

	/**
	 * Pobiera aktywne serwery do listy
	 * @return array lista
	 */
	public static function getMultioptions() {
		$rows = \Cms\Model\Mail\Server\Query::factory()
			->whereActive()->equals(1)
			->find();
		$pairs = array();
		foreach ($rows as $row) {
			$pairs[$row->id] = $row->address . ':' . $row->port . ' (' . $row->username . ')';
		}
		return $pairs;
	}

}
