<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Controller/Action/Helper/Redirector.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper przekierowań
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Action_Helper_Redirector extends Mmi_Controller_Action_Helper_Abstract {

	/**
	 * Obiekt router
	 * @var Mmi_Controller_Router
	 */
	protected static $_router;

	/**
	 * Ustawia obiekt routera
	 * @param Mmi_Controller_Router $router
	 * @return \Mmi_Controller_Router
	 */
	public static function setRouter(Mmi_Controller_Router $router) {
		self::$_router = $router;
		return $router;
	}

	/**
	 * Metoda główna, wykonuje gotoSimple
	 * @see Mmi_Controller_Action_Helper_Redirector::gotoSimple()
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
		$response = Mmi_Controller_Front::getInstance()->getResponse();
		$response->setCode($code);
		return $this;
	}

	/**
	 * Przekierowanie wewnątrz systemu (z użyciem routera)
	 * Buduje URL za pomocą routera i wykonuje gotoUrl()
	 * @see Mmi_Controller_Router::encodeUrl()
	 * @see Mmi_Controller_Action_Helper_Redirector::gotoUrl()
	 * @param array $params parametry dla routy
	 */
	public function gotoRoute(array $params = array()) {
		if (self::$_router === null) {
			throw new Exception('Mmi_Controller_Action_Helper_Redirector: supply router object before use');
		}
		$this->gotoUrl(self::$_router->encodeUrl($params));
	}

	/**
	 * Przekierowanie wewnątrz systemu (z użyciem routera, lecz z uproszczonymi parametrami)
	 * @see Mmi_Controller_Action_Helper_Redirector::gotoRoute()
	 * @param string $action akcja
	 * @param string $controller kontroler
	 * @param string $module moduł
	 * @param array $params parametry
	 * @param bool $reset restart
	 */
	public function gotoSimple($action = null, $controller = null, $module = null, array $params = array(), $reset = false) {
		if (!$reset) {
			$requestParams = Mmi_Controller_Front::getInstance()->getRequest()->toArray();
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
		$response = Mmi_Controller_Front::getInstance()->getResponse();
		$response->setHeader('Location', $url);
		exit;
	}

}
