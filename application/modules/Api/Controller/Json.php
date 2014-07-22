<?php

class Api_Controller_Json extends Mmi_Controller_Action {

	public function serverAction() {
		try {
			$apiModel = $this->_getModelName($this->obj);
			//serwer z autoryzacją HTTP
			if (Mmi_Controller_Front::getInstance()->getEnvironment()->authUser) {
				$apiModel .= '_Private';
				$auth = new Mmi_Auth();
				$auth->setModelName($apiModel);
				$auth->httpAuth('Private API', 'Access denied!');
			}
			return Mmi_Json_Rpc_Server::handle($apiModel);
		} catch (Exception $e) {
			Mmi_Exception_Logger::log($e);
			$this->getResponse()->setCodeError();
			return '<html><body><h1>JSON service failed</h1></body></html>';
		}
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
