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
		$env = Mmi_Controller_Front::getInstance()->getEnvironment();
		if (Mmi_Session::namespaceIsset('Auth')) {
			$authNamespace = new Mmi_Session_Namespace('Auth');
			$record->cms_auth_id = $authNamespace->id;
		}
		$record->url = $env->requestUri;
		$record->ip = $env->remoteAddress;
		$record->browser = $env->httpUserAgent;
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

	public static function clean($months = 24) {
		$q = self::newQuery()
				->where('dateTime')->less(date('Y-m-d H:i:s', strtotime('-' . $months . ' month')));
		return self::find($q)->delete();
	}

}
