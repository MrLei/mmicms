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
 * Mmi/View/Helper/Url.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper tworzenia linku
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_Url extends Mmi_View_Helper_Abstract {

	/**
	 * Generuje link na podstawie parametrów (z użyciem routera)
	 * @see Mmi_Controller_Router::encodeUrl()
	 * @param array $params parametry
	 * @param boolean $reset nie łączy z bierzącym requestem
	 * @param boolean $absolute czy ścieżka bezwzględna
	 * @param boolean | null $https czy wymusić https: tak, nie https, null = bez zmiany protokołu
	 * @param array $unset odłącz parametr
	 * @return string
	 */
	public function url(array $params = array(), $reset = false, $absolute = false, $https = null, array $unset = array()) {
		if (!$reset) {
			$params = array_merge(Mmi_Controller_Front::getInstance()->getRequest()->toArray(), $params);
		}
		foreach ($params as $key => $param) {
			if (null === $param) {
				unset($params[$key]);
			}
		}
		foreach ($unset as $key => $param) {
			if (is_int($key) && is_string($param)) {
				unset($params[$param]);
				continue;
			}
			if (is_string($key) && !is_array($param)) {
				unset($params[$key]);
				continue;
			}
			if (!isset($params[$key])) {
				continue;
			}
			if (!is_array($params[$key])) {
				unset($params[$key]);
				continue;
			}
			foreach ($param as $unsetKey) {
				unset($params[$key][$unsetKey]);
			}
			sort($params[$key]);
			if (empty($params[$key])) {
				unset($params[$key]);
			}
		}
		$url = Mmi_Controller_Front::getInstance()->getRouter()->encodeUrl($params);
		$url = str_replace(array('&', ' '),	array('%26', '+'), $url);
		if (!is_null($https)) {
			$absolute = true;
		}
		if ($absolute) {
			$protocol = 'http://';
			if (Mmi_Controller_Front::getInstance()->getEnvironment()->httpSecure) {
				$protocol = 'https://';
			}
			if (!is_null($https)) {
				if ($https) {
					$protocol = 'https://';
				} else {
					$protocol = 'http://';
				}
			}
			$url = $protocol . $this->view->domain . $url;
		}
		return $url ? $url : '/';
	}

}
