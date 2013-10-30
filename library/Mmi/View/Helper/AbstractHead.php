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
 * Mmi/View/Helper/AbstractHead.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa nagłówkowych helperów widoku
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_AbstractHead extends Mmi_View_Helper_Abstract {

	/**
	 * Pobiera CRC dla danego zasobu (lokalnego lub zdalnego)
	 * @param string $location adres zasobu
	 * @return string
	 */
	protected function _getCrc($location) {
		$cacheKey = 'Head_Crc_' . md5($location);
		if (null !== ($crc = Mmi_Cache::load($cacheKey))) {
			return $crc;
		}
		//internal
		$online = true;
		if (preg_match('/^http[s]?/i', $location) == 0) {
			if (strrpos($location, '?') !== false) {
				$location = substr($location, 0, strrpos($location, '?'));
			}
			$baseUrlLength = strlen(Mmi_Controller_Front::getInstance()->getRequest()->getBaseUrl());
			$location = PUBLIC_PATH . substr($location, $baseUrlLength);
			$online = false;
		}
		if (!$online && !file_exists($location)) {
			$crc = 0;
		} else {
			$crc = crc32(file_get_contents($location));
		}
		Mmi_Cache::save($crc, $cacheKey);
		return $crc;
	}

}
