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
 * Mmi/Exception/Logger.php
 * @category   Mmi
 * @package    Mmi_Exception
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa logująca wyjątki do pliku
 * @category   Mmi
 * @package    Mmi_Exception
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Exception_Logger {

	public static function log(Exception $exception) {
		$log = fopen(TMP_PATH . '/log/error.execution.log', 'a');
		$info = '';
		foreach ($exception->getTrace() as $position) {
			if (isset($position['file'])) {
				$info .= ' ' . $position['file'] . '(' . $position['line'] . '): ' . $position['function'] . "\n";
			}
		}
		$info = trim($info, "\n");
		$position['info'] = $info;
		date_default_timezone_set('Europe/Warsaw');
		$requestUri = Mmi_Controller_Front::getInstance()->getEnvironment()->requestUri;
		$message = date('Y-m-d H:i:s') . ' ' . $requestUri . "\n" . strip_tags($exception->getMessage() . ': ' . $exception->getFile() . '(' . $exception->getLine() . ')' . $info);
		fwrite($log, $message . "\n\n");
		fclose($log);
		return $position;
	}

}
