<?php

class Cms_Model_Mail_Server_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_server';

	/**
	 * Pobiera aktywne serwery do listy
	 * @return array lista
	 */
	public static function getMultioptions() {
		$rows = Cms_Model_Mail_Server_Query::factory()
			->whereActive()->equals(1)
			->find();
		$pairs = array();
		foreach ($rows as $row) {
			$pairs[$row->id] = $row->address . ':' . $row->port . ' (' . $row->username . ')';
		}
		return $pairs;
	}

}
