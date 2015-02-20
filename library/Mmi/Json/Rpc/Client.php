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
 * Mmi/Json/Rpc/Client.php
 * @category   Mmi
 * @package    \Mmi\Json\Rpc\Client
 * @copyright  Copyright (c) 2011 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klient JSON-RPC
 * @category   Mmi
 * @package    \Mmi\Json\Rpc\Client
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Json\Rpc;

class Client {

	/**
	 * Adres serwera RPC
	 * @var string
	 */
	protected $_url;

	/**
	 * Dane debuggera
	 * @var boolean
	 */
	protected $_debug = false;

	/**
	 * Dane debuggera
	 * @var array
	 */
	protected $_debugData = array();

	/**
	 * Konstruktor
	 * @param string $url Adres serwera RPC
	 * @param boolean $debug Włącza debugger
	 */
	public function __construct($url, $debug = false) {
		$this->_url = $url;
		$this->_debug = $debug;
	}

	/**
	 * Wykonuje metodę JSON-RPC i zwraca tablicę
	 * @param string $method
	 * @param array $params
	 * @return array
	 */
	public function __call($method, array $params) {

		//sprawdzenie nazwy metody
		if (!is_scalar($method)) {
			throw new Exception('Incorrect method name.');
		}

		//walidacja nazwy metody
		if (!preg_match('/(get|post|put|delete)([a-z0-9\-\_]+)/i', $method, $matches)) {
			throw new Exception('Method name must start with get, post, put or delete.');
		}

		//określenie typu żądania i nazwy metody
		$httpMethod = strtoupper($matches[1]);
		$method = lcfirst($matches[2]);
		$id = (microtime(true) * 10000);

		//przygotowanie żądania
		$request = new \Mmi\Json\Rpc\Request();
		$request->jsonrpc = '2.0';
		$request->method = $method;
		$request->params = array_values($params);
		$request->id = $id;

		//pobieranie odpowiedzi z serwera
		try {
			$rawResponse = (string) file_get_contents($this->_url, false, stream_context_create(array('http' => array(
						'method' => $httpMethod,
						'header' => array('Content-type: application/json', 'Connection: close'),
						'content' => $request->toJson()
			))));
			$this->_debug($id, $this->_url, $request, $rawResponse, $httpMethod);
			$response = new \Mmi\Json\Rpc\Response();
			$response->setFromJson($rawResponse);
		} catch (Exception $e) {
			$message = substr($e->getMessage(), 30 + strpos($e->getMessage(), 'HTTP request failed! '));
			$message = substr($message, 0, strpos($message, '[') - 2);
			throw new Exception('Service error: ' . $message . '.');
		}
		if (!is_object($response)) {
			throw new Exception('Service response is not a valid JSON-RPC response, RAW response: ' . $rawResponse);
		}
		if (!property_exists($response, 'result')) {
			throw new Exception('Service response missing field: "result".');
		}
		if (!property_exists($response, 'id')) {
			throw new Exception('Service response missing field: "id".');
		}
		if ((string) $id != (string) $response->id) {
			throw new Exception('Invalid response "id".');
		}
		//błędy zdefiniowane przez serwer
		if (isset($response->error) && is_object($response->error)) {
			$errorMessage = $response->error->message;
			if (isset($response->error->data) && isset($response->error->data->details)) {
				$errorMessage .= ' ' . $response->error->data->details;
			}
			if (isset($response->error->code) && $response->error->code == -10) {
				throw new \Mmi\Json\Rpc\Data\Exception($errorMessage);
			}
			if (isset($response->error->code) && $response->error->code == -500) {
				throw new \Mmi\Json\Rpc\General\Exception($errorMessage);
			}
			throw new Exception($errorMessage);
		}
		return $response->result;
	}
	
	/**
	 * Zwraca dane
	 * @return array
	 */
	public function getDebugData() {
		if (!$this->_debug) {
			throw new Exception('Debugger not enabled!');
		}
		return $this->_debugData;
	}

	/**
	 * Zapisuje dane debugujące
	 * @param string $id
	 * @param string $request
	 * @param string $response
	 * @param string $method
	 */
	protected function _debug($id, $url, $request, $response, $method) {
		if (!$this->_debug) {
			return;
		}
		$this->_debugData[] = array('request' => $request,
			'url' => $url,
			'response' => $response,
			'method' => $method
		);
	}

}
