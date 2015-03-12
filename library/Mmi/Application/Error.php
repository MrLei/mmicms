<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Application;

class Error {

	/**
	 * Obsługuje błędy, ostrzeżenia
	 * @param string $errno numer błędu
	 * @param string $errstr treść błędu
	 * @param string $errfile plik
	 * @param string $errline linia z błędem
	 * @param string $errcontext kontekst
	 * @return boolean
	 */
	public static function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
		if (error_reporting() > 0) {
			switch ($errno) {
				case 2:
					$code = 'WARNING';
					break;
				case 4:
					$code = 'PARSE';
					break;
				case 8:
					$code = 'NOTICE';
					break;
				case 2048:
					$code = 'STRICT';
					break;
				default:
					$code = 'OTHER';
			}
			if (!is_writable(TMP_PATH . '/compile')) {
				mkdir(TMP_PATH . '/compile', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/cache')) {
				mkdir(TMP_PATH . '/cache', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/session')) {
				mkdir(TMP_PATH . '/session', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/log')) {
				mkdir(TMP_PATH . '/log', 0777, true);
			}
			throw new \Exception($code . ': ' . $errstr . '[' . $errfile . ' (' . $errline . ')]');
		}
		return true;
	}

	/**
	 * Obsługuje wyjątki
	 * @param Exception $exception wyjątek
	 * @return boolean
	 */
	public static function exceptionHandler(\Exception $exception) {
		//czyszczenie bufora
		ob_clean();
		//logowanie błędu
		\Mmi\Exception\Logger::log($exception);
		$response = \Mmi\Controller\Front::getInstance()->getResponse();
		try {
			$view = \Mmi\Controller\Front::getInstance()->getView();
			$view->_exception = $exception;
			//błąd bez layoutu lub nie HTML
			if ($view->isLayoutDisabled() || $response->getType() != 'html') {
				$response
					->setCodeError()
					->setContent(self::rawErrorResponse($response, $exception))
					->send();
				return true;
			}
			//błąd z prezentacją HTML
			$response
				->setCodeError()
				->setContent($view->setPlaceholder('content', \Mmi\Controller\Action\Helper\Action::getInstance()->action(['module' => 'core', 'controller' => 'error', 'action' => 'index']))
					->renderLayout($view->skin, 'core', 'error'))
				->send();
			return true;
		} catch (\Exception $e) {
			//domyślna prezentacja błędów
			$response
				->setCodeError()
				->setContent(self::rawErrorResponse($response, $exception))
				->send();
		}
		return true;
	}

	/**
	 * Zwraca sformatowany błąd dla danego typu odpowiedzi
	 * @param \Mmi\Controller\Response $response obiekt odpowiedzi
	 * @param \Exception $e wyjątek
	 * @return mixed
	 */
	public static function rawErrorResponse(\Mmi\Controller\Response $response, \Exception $e) {
		switch ($response->getType()) {
			//typy HTML
			case 'htm':
			case 'html':
			case 'shtml':
				return '<html><body><h1>' . $e->getMessage() . '</h1>' . nl2br($e->getTraceAsString()) . '</body></html>';
			//plaintext
			case 'txt':
				return $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
			//json
			case 'json':
				return json_encode(array(
					'status' => 500,
					'error' => $e->getMessage(),
					'exception' => $e->getTraceAsString(),
				));
		}
	}

}
