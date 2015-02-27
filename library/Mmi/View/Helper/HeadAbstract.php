<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/View/Helper/HeadAbstract.php
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Abstrakcyjna klasa nagłówkowych helperów widoku
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\View\Helper;

class HeadAbstract extends HelperAbstract {

	/**
	 * Pobiera CRC dla danego zasobu (lokalnego lub zdalnego)
	 * @param string $location adres zasobu
	 * @return string
	 */
	protected function _getCrc($location) {
		$cacheKey = 'Head-Crc-' . md5($location);
		$cache = $this->view->getCache();
		if ($cache !== null && (null !== ($crc = $cache->load($cacheKey)))) {
			return $crc;
		}
		//internal
		$online = true;
		if (preg_match('/^http[s]?/i', $location) == 0) {
			if (strrpos($location, '?') !== false) {
				$location = substr($location, 0, strrpos($location, '?'));
			}
			$baseUrlLength = strlen($this->view->baseUrl);
			$location = PUBLIC_PATH . substr($location, $baseUrlLength);
			$online = false;
		}
		if (!$online && !file_exists($location)) {
			$crc = 0;
		} else {
			$crc = crc32(file_get_contents($location));
		}
		if ($cache !== null) {
			$cache->save($crc, $cacheKey);
		}
		return $crc;
	}

}
