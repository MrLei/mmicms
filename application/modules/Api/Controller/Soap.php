<?php

class Api_Controller_Soap extends Mmi_Controller_Action {

	public function serverAction() {
		try {
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'wsdl',
				'obj' => $this->_getParam('obj'),
				'identity' => $this->_getParam('identity'),
				'credential' => $this->_getParam('credential')
				), true, true, $this->_ssl());
			$apiModel = $this->_filterApiName($this->_getParam('obj')) . '_Model_Api';
			if ($this->_getParam('identity')) {
				$apiModel .= '_Private';
				$this->_auth($apiModel);
			}
			$soap = new SoapServer($url);
			$soap->setClass($apiModel);
			$soap->handle();
		} catch (Exception $e) {
			die('SOAP server failed!');
		}
		exit;
	}

	public function clientAction() {
		//dla typu prywatnego ustawienie loginu i hasła
		$url = $this->view->url(array(
			'module' => 'api',
			'controller' => 'soap',
			'action' => 'wsdl',
			'obj' => $this->_getParam('obj'),
			'identity' => $this->_getParam('identity'),
			'credential' => $this->_getParam('credential')
			), true, true, $this->_ssl());
		$client = new SoapClient($url);
		parse_str($this->_getParam('params'), $params);
		var_dump($client->__soapCall($this->_getParam('method'), $params));
		exit;
	}

	public function wsdlAction() {
		try {
			$apiModel = $this->_filterApiName($this->_getParam('obj')) . '_Model_Api';
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'server',
				'obj' => $this->_getParam('obj'),
				'identity' => $this->_getParam('identity'),
				'credential' => $this->_getParam('credential')
				), true, true, $this->_ssl());
			if ($this->_getParam('identity')) {
				$apiModel .= '_Private';
				$this->_auth($apiModel);
			}
			//@TODO: przepisać do ZF2
			$autodiscover = new Zend_Soap_AutoDiscover();
			$autodiscover->setClass($apiModel);
			$autodiscover->setUri($url);
			$autodiscover->handle();
		} catch (Exception $e) {
			header('HTTP/1.1 500 Internal Server Error');
		}
		exit;
	}

	protected function _filterApiName($name) {
		return ucfirst(preg_replace('/[^\p{L}\p{N}-_]/u', '', $name));
	}

	protected function _ssl() {
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || $_SERVER['SERVER_PORT'] == 443;
	}

	protected function _auth($apiModel) {
		$auth = new $apiModel;
		if (!$auth->authenticate($this->_getParam('identity'), $this->_getParam('credential'))) {
			die('SOAP server authorization failed!');
		}
	}

}