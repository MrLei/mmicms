<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Exception;

class Logger {

	public static function log(\Exception $exception) {
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
		$requestUri = \Mmi\Controller\Front::getInstance()->getEnvironment()->requestUri;
		$message = date('Y-m-d H:i:s') . ' ' . $requestUri . "\n" . strip_tags($exception->getMessage() . ': ' . $exception->getFile() . '(' . $exception->getLine() . ')' . $info);
		fwrite($log, $message . "\n\n");
		fclose($log);
		return $position;
	}

}
