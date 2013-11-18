<?php

class Api_Controller_Json extends Mmi_Controller_Action {
	
	public function serverAction() {
		try {
			$apiModel = $this->_filterApiName($this->_getParam('obj')) . '_Model_Api';
			//prywatny serwer
			if (isset($_SERVER['PHP_AUTH_USER'])) {
				$apiModel .= '_Private';
				$auth = Default_Registry::$auth;
				$auth->setModel(new $apiModel);
				$auth->httpAuth('Private API', 'Access denied!');
			}
			$rpc = new Mmi_Json_Rpc_Server();
			$rpc->handle($apiModel);
		} catch (Exception $e) {
			header("HTTP/1.1 500 Internal Server Error");
		}
		exit;
	}

	public function clientAction() {
		$url = $this->view->url(array(
			'module' => 'api',
			'controller' => 'json',
			'action' => 'server',
			'obj' => $this->_getParam('obj'),
		), true, true);
		//dla typu prywatnego ustawienie loginu i hasła
		if ($this->_getParam('identity')) {
			$url = str_replace('http://', 'http://' . $this->_getParam('identity') . ':' . $this->_getParam('credential') . '@', $url);
		}
		$client = new Mmi_Json_Rpc_Client($url);
		parse_str($this->_getParam('params'), $params);
		var_dump($client->__call($this->_getParam('method'), $params));
		exit;
	}
	
	protected function _filterApiName($name) {
		return ucfirst(preg_replace('/[^\p{L}\p{N}-_]/u', '', $name));
	}
	
}