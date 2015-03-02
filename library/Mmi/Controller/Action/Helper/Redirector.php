<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Action\Helper;

class Redirector extends \Mmi\Controller\Action\Helper\HelperAbstract {

	/**
	 * Metoda główna, wykonuje gotoSimple
	 * @see \Mmi\Controller\Action\Helper\Redirector::gotoSimple()
	 * @param string $action akcja
	 * @param string $controller kontroler
	 * @param string $module moduł
	 * @param array $params parametry
	 * @param bool $reset restart
	 */
	public function redirector($action = null, $controller = null, $module = null, array $params = array(), $reset = false) {
		if (null == $action) {
			return $this;
		}
		$this->gotoSimple($action, $controller, $module, $params, $reset);
	}

	/**
	 * Ustawia kod HTTP przekierowania (np. 301)
	 * @param int $code kod
	 */
	public function setCode($code) {
		$response = \Mmi\Controller\Front::getInstance()->getResponse();
		$response->setCode($code);
		return $this;
	}

	/**
	 * Przekierowanie wewnątrz systemu (z użyciem routera)
	 * Buduje URL za pomocą routera i wykonuje gotoUrl()
	 * @see \Mmi\Controller\Router::encodeUrl()
	 * @see \Mmi\Controller\Action\Helper\Redirector::gotoUrl()
	 * @param array $params parametry dla routy
	 */
	public function gotoRoute(array $params = array()) {
		$this->gotoUrl(\Mmi\Controller\Front::getInstance()->getRouter()->encodeUrl($params));
	}

	/**
	 * Przekierowanie wewnątrz systemu (z użyciem routera, lecz z uproszczonymi parametrami)
	 * @see \Mmi\Controller\Action\Helper\Redirector::gotoRoute()
	 * @param string $action akcja
	 * @param string $controller kontroler
	 * @param string $module moduł
	 * @param array $params parametry
	 * @param bool $reset restart
	 */
	public function gotoSimple($action = null, $controller = null, $module = null, array $params = array(), $reset = false) {
		if (!$reset) {
			$requestParams = $this->getRequest()->toArray();
			$params = array_merge($requestParams, $params);
		}
		if ($action !== null) {
			$params['action'] = $action;
		}
		if ($controller !== null) {
			$params['controller'] = $controller;
		}
		if ($module !== null) {
			$params['module'] = $module;
		}
		$this->gotoRoute($params);
	}

	/**
	 * Przekierowanie na dowolny URL
	 * @param string $url adres url
	 */
	public function gotoUrl($url) {
		$response = \Mmi\Controller\Front::getInstance()->getResponse();
		$response->setHeader('Location', $url);
		exit;
	}

}
