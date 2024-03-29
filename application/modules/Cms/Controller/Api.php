<?php

class Cms_Controller_Api extends Mmi_Controller_Action {

	public function jsonServerAction() {
		try {
			$this->getResponse()
				->setHeader('Access-Control-Allow-Origin', '*')
				->setHeader('Access-Control-Allow-Headers', 'Content-Type')
				->setTypeJson();
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
			return $this->_internalError($e);
		}
	}

	public function soapServerAction() {
		try {
			$apiModel = $this->_getModelName($this->obj);
			$wsdlParams = array(
				'module' => 'cms',
				'controller' => 'api',
				'action' => 'wsdl',
				'obj' => $this->obj,
			);
			//prywatny serwer
			if (Mmi_Controller_Front::getInstance()->getEnvironment()->authUser) {
				$apiModel .= '_Private';
				$auth = new Mmi_Auth();
				$auth->setModelName($apiModel);
				$auth->httpAuth('Private API', 'Access denied!');
				$wsdlParams['type'] = 'private';
			}
			$url = $this->view->url($wsdlParams, true, true, $this->_isSsl());
			$this->getResponse()->setTypeXml();
			$soap = new SoapServer($url);
			$soap->setClass($apiModel);
			$soap->handle();
			return '';
		} catch (Exception $e) {
			return $this->_internalError($e);
		}
	}

	public function wsdlAction() {
		try {
			$apiModel = $this->_getModelName($this->obj);
			$serverParams = array(
				'module' => 'cms',
				'controller' => 'api',
				'action' => 'soapServer',
				'obj' => $this->obj,
			);
			if ($this->type == 'private' || Mmi_Controller_Front::getInstance()->getEnvironment()->authUser) {
				$apiModel .= '_Private';
			}
			$url = $this->view->url($serverParams, true, true, $this->_isSsl());
			//@TODO: przepisać do ZF2
			$this->getResponse()->setTypeXml();
			$autodiscover = new Zend_Soap_AutoDiscover();
			$autodiscover->setClass($apiModel);
			$autodiscover->setUri($url);
			$autodiscover->handle();
			return '';
		} catch (Exception $e) {
			$this->_internalError($e);
		}
	}

	protected function _getModelName($object) {
		$obj = explode('_', preg_replace('/[^\p{L}\p{N}-_]/u', '', $object));
		foreach ($obj as $k => $v) {
			$obj[$k] = ucfirst($v);
		}
		$class = $obj[0] . '_Model_';
		unset($obj[0]);
		return rtrim($class . implode('_', $obj), '_') . '_Api';
	}

	protected function _internalError($e) {
		Mmi_Exception_Logger::log($e);
		$this->getResponse()->setCodeError();
		return '<html><body><h1>Soap service failed</h1></body></html>';
	}

	protected function _isSsl() {
		return Mmi_Controller_Front::getInstance()->getEnvironment()->httpSecure;
	}

}
