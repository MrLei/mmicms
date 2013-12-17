<?php

class Cms_Model_Log_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_log';

	/**
	 * Dodaje zdarzenie do logu
	 * @param string $operation operacja
	 * @param array $data dane
	 * @return bool czy dodano
	 */
	public static function add($operation = null, array $data = array()) {
		$record = new Cms_Model_Log_Record();
		if (Mmi_Session::namespaceIsset('Auth')) {
			$authNamespace = new Mmi_Session_Namespace('Auth');
			$record->cms_auth_id = $authNamespace->id;
		}
		$record->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$record->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$record->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
		}
		$record->browser = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown';
		$record->dateTime = date('Y-m-d H:i:s');
		$record->operation = $operation;
		$record->success = 1;
		if (!empty($data)) {
			if (isset($data['success'])) {
				$record->success = $data['success'] ? 1 : 0;
				unset($data['success']);
			}
			if (isset($data['object'])) {
				$record->object = $data['object'];
				unset($data['object']);
			}
			if (isset($data['objectId'])) {
				$record->objectId = $data['objectId'];
				unset($data['objectId']);
			}
			if (isset($data['cms_auth_id']) && !$record->cms_auth_id) {
				$record->cms_auth_id = $data['cms_auth_id'];
				unset($data['cms_auth_id']);
			}
			if (!empty($data)) {
				$record->data = serialize($data);
			}
		}
		return $record->save();
	}

	public static function clean() {
		$q = self::newQuery()
			->where('dateTime')->less(date('Y-m-d H:i:s', strtotime('-2 year')));
		return self::find($q)->delete();
	}

}