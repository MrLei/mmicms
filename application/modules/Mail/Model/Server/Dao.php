<?php

class Mail_Model_Server_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_server';

	/**
	 * Pobiera aktywne serwery do listy
	 * @return array lista
	 */
	public static function findPairsActive() {
		$rows = self::find(array(array('active', 1)));
		$pairs = array();
		foreach ($rows as $row) {
			$pairs[$row->id] = $row->address . ':' . $row->port . ' (' . $row->username . ')';
		}
		return $pairs;
	}

}