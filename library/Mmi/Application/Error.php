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
 * Mmi/Application/Error.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa obsługi błędów i wyjątków aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Application_Error {

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
			throw new Exception($code . ': ' . $errstr . '[' . $errfile . ' (' . $errline . ')]');
		}
		return true;
	}

	/**
	 * Obsługuje wyjątki
	 * @param Exception $exception wyjątek
	 * @return boolean
	 */
	public static function exceptionHandler(Exception $exception) {
//		ob_clean();
		Mmi_Exception_Logger::log($exception);
		$response = Mmi_Controller_Front::getInstance()->getResponse();
		try {
			$view = Mmi_Controller_Front::getInstance()->getView();
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
			$actionHelper = new Mmi_Controller_Action_Helper_Action();
			$response
				->setCodeError()
				->setContent($view->setPlaceholder('content', $actionHelper->action('default', 'error', 'index', array()))
					->renderLayout($view->skin, 'default', 'error'))
				->send();
			return true;
		} catch (Exception $e) {
			$response
				->setCodeError()
				->setContent(self::rawErrorResponse($response, $exception))
				->send();
		}
		return true;
	}

	public static function rawErrorResponse(Mmi_Controller_Response $response, Exception $e) {
		$content = '';
		switch ($response->getType()) {
			case 'htm':
			case 'html':
			case 'shtml':
				$content = '<html><body><h1>' . $e->getMessage() . '</h1>' . nl2br($e->getTraceAsString()) . '</body></html>';
				break;
			case 'json':
				$content = json_encode(array(
					'status' => 500,
					'error' => $e->getMessage(),
					'exception' => $e->getTraceAsString(),
				));
				break;
		}
		return $content;
	}

}
