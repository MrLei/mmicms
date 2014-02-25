<?php

class Api_Controller_Json extends Mmi_Controller_Action {

	public function serverAction() {
		try {
			$apiModel = $this->_getModelName($this->_getParam('obj'));
			//prywatny serwer
			if ($this->_getParam('type') === 'private') {
				$apiModel .= '_Private';				
				$auth = new Mmi_Auth();
				$auth->setModelName($apiModel);
				$auth->httpAuth('Private API', 'Access denied!');
			}
			$rpc = new Mmi_Json_Rpc_Server();
			$rpc->handle($apiModel);
		} catch (Exception $e) {
			header('HTTP/1.1 500 Internal Server Error');
			die('<html><body><h1>JSON service failed</h1></body></html>');
		}
		exit;
	}

	protected function _getModelName($object) {
		$object = preg_replace('/[^\p{L}\p{N}-_]/u', '', $object);
		$obj = explode('_', $object);
		foreach ($obj as $k => $v) {
			$obj[$k] = ucfirst($v);
		}
		$class = $obj[0] . '_Model_';
		unset($obj[0]);
		return rtrim($class . implode('_', $obj), '_') . '_Api';
	}

}