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
 * Mmi/Json/Rpc/Server.php
 * @category   Mmi
 * @package    \Mmi\Json\Rpc\Server
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Serwer JSON-RPC w standardzie 2.0
 * @category   Mmi
 * @package    \Mmi\Json\Rpc\Server
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Json\Rpc;

class Server {

	/**
	 * Obsługa serwera
	 * @param string $className nazwa klasy
	 * @return string odpowiedź JSON
	 */
	public static function handle($className) {

		$response = new \Mmi\Json\Rpc\Response();
		$request = new \Mmi\Json\Rpc\Request();

		//wczytywanie danych
		try {
			$httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
			$getRpcVersion = filter_input(INPUT_GET, 'jsonrpc', FILTER_SANITIZE_SPECIAL_CHARS);
			if ($httpMethod == 'GET' && $getRpcVersion) {
				$request->jsonrpc = $getRpcVersion;
				$request->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
				$request->method = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS);
				$request->params = json_decode(filter_input(INPUT_GET, 'params', FILTER_SANITIZE_URL), true);
			} else {
				$request = $request->setFromArray(json_decode(file_get_contents('php://input'), true));
			}
			if (!is_array($request->params)) {
				$request->params = array();
			}
		} catch (Exception $e) {
			$response->error = self::_newErrorInvalidRequest(array(
					'details' => 'Request is not in a JSON format.'
			));
			return $response->toJson();
		}

		//niewłaściwa wersja jsonrpc
		if ($request->jsonrpc != '2.0') {
			$response->error = self::_newErrorInvalidRequest(array(
					'details' => 'Missing request "jsonrpc", or not 2.0 version.'
			));
			return $response->toJson();
		}

		//brak id
		if (!$request->id) {
			$response->error = self::_newErrorInvalidRequest(array(
					'details' => 'Missing request "id".'
			));
			return $response->toJson();
		}
		$response->id = $request->id;

		//walidacja nazwy metody
		if (!preg_match('/^[a-z0-9\-\_]+$/i', $request->method)) {
			$response->error = self::_newErrorMethodNotFound(array(
					'details' => 'Method name "' . $request->method . '" is invalid in class " ' . $className . '".'
			));
			return $response->toJson();
		}

		//filtrowanie nazwy metody
		$method = strtolower($httpMethod) . ucfirst($request->method);

		//wykonanie metody
		try {
			if ($method == 'getMethodList') {
				$reflection = new \Mmi\Json\Rpc\Server\Reflection($className);
				$response->result = $reflection->getMethodList();
				return $response->toJson();
			}
			$object = new $className();
			$response->result = call_user_func_array(array($object, $method), $request->params);
			return $response->toJson();
			//wykonanie nie powiodło się
		} catch (\Mmi\Json\Rpc\Data\Exception $e) {
			$response->error = self::_newError($e->getCode(), $e->getMessage());
			return $response->toJson();
		} catch (\Mmi\Json\Rpc\General\Exception $e) {
			$response->error = self::_newError($e->getCode(), $e->getMessage());
			return $response->toJson();
		} catch (Exception $e) {
			//objekt i metoda istnieją, błąd ilości parametrów
			if (isset($object) && is_object($object) && method_exists($object, $method) && strpos($e->getMessage(), 'WARNING: Missing argument') !== false && strpos($e->getMessage(), 'and defined') === false) {
				$response->error = self::_newErrorInvalidParams(array(
						'details' => 'Invalid method "' . $method . '" parameter count (' . count($request->params) . ') in class "' . $className . '".',
				));
				return $response->toJson();
			}
			//błąd metody
			if (isset($object) && is_object($object) && method_exists($object, $method)) {
				\Mmi\Exception\Logger::log($e);
				$response->error = self::_newErrorInternal(array(
						'details' => 'Method "' . $method . '" failed in class "' . $className . '".'
				));
				return json_encode($response);
			}
			//brak metody w serwisie
			if (isset($object)) {
				$response->error = self::_newErrorMethodNotFound(array(
						'details' => 'Method "' . $method . '" is not implemented in class "' . $className . '".'
				));
				return $response->toJson();
			}
			//błąd powołania obiektu
			$response->error = self::_newErrorInternal(array(
					'details' => 'General service error in class "' . $className . '".'
			));
			return $response->toJson();
		}
	}

	/**
	 * Bład parsowania żądania
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newErrorParse(array $data = array()) {
		return self::_newError(-32700, 'Invalid JSON was received by the server. An error occurred on the server while parsing the JSON text.', $data);
	}

	/**
	 * Błedne żądanie
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newErrorInvalidRequest(array $data = array()) {
		return self::_newError(-32600, 'The JSON sent is not a valid Request object.', $data);
	}

	/**
	 * Brak metody
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newErrorMethodNotFound(array $data = array()) {
		return self::_newError(-32601, 'The method does not exist / is not available.', $data);
	}

	/**
	 * Bład parametrów metody
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newErrorInvalidParams(array $data = array()) {
		return self::_newError(-32602, 'Invalid method parameter(s).', $data);
	}

	/**
	 * Błąd wewnętrzny serwera
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newErrorInternal(array $data = array()) {
		return self::_newError(-32603, 'Internal JSON-RPC error.', $data);
	}

	/**
	 * Generuje błąd do odpowiedzi
	 * @param integer $code
	 * @param string $message
	 * @param array $data opcjonalne dane
	 * @return array
	 */
	protected static function _newError($code, $message, array $data = array()) {
		return array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
		);
	}

}
