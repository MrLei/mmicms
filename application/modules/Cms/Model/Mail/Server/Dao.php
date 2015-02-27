<?php

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
