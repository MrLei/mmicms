<?php

class Api_Controller_Soap extends Mmi_Controller_Action {

	public function serverAction() {
		try {
			$apiModel = $this->_getModelName($this->obj);
			//prywatny serwer
			if ($this->type == 'private') {
				$apiModel .= '_Private';
				$auth = new Mmi_Auth();
				$auth->setModelName($apiModel);
				$auth->httpAuth('Private API', 'Access denied!');
			}
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'wsdl',
				'obj' => $this->obj,
				'type' => $this->type,
				), true, true, $this->_isSsl());
			$this->getResponse()->setTypeXml();
			$soap = new SoapServer($url);
			$soap->setClass($apiModel);
			$soap->handle();
			return '';
		} catch (Exception $e) {
			Mmi_Exception_Logger::log($e);
			$this->getResponse()->setCodeError();
			return '<html><body><h1>Soap service failed</h1></body></html>';
		}
	}

	public function wsdlAction() {
		try {
			$apiModel = $this->_getModelName($this->obj);
			$url = $this->view->url(array(
				'module' => 'api',
				'controller' => 'soap',
				'action' => 'server',
				'obj' => $this->obj,
				'type' => $this->type
				), true, true, $this->_isSsl());
			if ($this->type === 'private') {
				$apiModel .= '_Private';
			}
			//@TODO: przepisać do ZF2
			$this->getResponse()->setTypeXml();
			$autodiscover = new Zend_Soap_AutoDiscover();
			$autodiscover->setClass($apiModel);
			$autodiscover->setUri($url);
			$autodiscover->handle();
			return '';
		} catch (Exception $e) {
			Mmi_Exception_Logger::log($e);
			$this->getResponse()->setCodeError();
			return '<html><body><h1>Soap service failed</h1></body></html>';
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

	protected function _isSsl() {
		return Mmi_Controller_Front::getInstance()->getEnvironment()->httpSecure;
	}

}
