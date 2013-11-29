<?php

class Api_Controller_Soap extends Mmi_Controller_Action {

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
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'wsdl',
				'obj' => $this->_getParam('obj'),
				'type' => $this->_getParam('type')
				), true, true, $this->_isSsl());
			$soap = new SoapServer($url);
			$soap->setClass($apiModel);
			$soap->handle();
		} catch (Exception $e) {
			Mmi_Exception_Logger::log($e);
			header('HTTP/1.1 500 Internal Server Error');
			die('<html><body><h1>Soap service failed</h1></body></html>');
		}
		exit;
	}

	public function wsdlAction() {
		try {
			$apiModel = $this->_getModelName($this->_getParam('obj'));
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'server',
				'obj' => $this->_getParam('obj'),
				'type' => $this->_getParam('type')
				), true, true, $this->_isSsl());
			if ($this->_getParam('type') === 'private') {
				$apiModel .= '_Private';
			}
			//@TODO: przepisać do ZF2
			$autodiscover = new Zend_Soap_AutoDiscover();
			$autodiscover->setClass($apiModel);
			$autodiscover->setUri($url);
			$autodiscover->handle();
		} catch (Exception $e) {
			header('HTTP/1.1 500 Internal Server Error');
			die('<html><body><h1>WSDL not found</h1></body></html>');
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

	protected function _isSsl() {
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || $_SERVER['SERVER_PORT'] == 443;
	}

}
