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
 * @package    Mmi_Json_Rpc_Client
 * @copyright  Copyright (c) 2011 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klient JSON-RPC
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Client
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Json_Rpc_Client {

	/**
	 * Adres serwera RPC
	 * @var string
	 */
	protected $_url;

	/**
	 * Konstruktor
	 * @param string $url Adres serwera RPC
	 */
	public function __construct($url) {
		$this->_url = $url;
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

		//sprawdzenie parametrów
		if (!is_array($params)) {
			$params = array();
		}

		//walidacja nazwy metody
		if (!preg_match('/(get|post|put|delete)([a-z0-9\-\_]+)/i', $method, $matches)) {
			throw new Exception('Method name must start with get, post, put or delete.');
		}
		
		//określenie typu żądania i nazwy metody
		$httpMethod = strtoupper($matches[1]);
		$method = $matches[2];

		//przygotowanie żądania
		$request = array(
			'jsonrpc' => '2.0',
			'method' => $method,
			'params' => array_values($params),
			'id' => (microtime(true) * 10000),
		);

		//pobieranie odpowiedzi z serwera
		try {
			$rawResponse = (string)file_get_contents($this->_url, false, stream_context_create(array('http' => array(
					'method' => $httpMethod,
					'header' => array('Content-type: application/json', 'Connection: close'),
					'content' => json_encode($request)
			))));
			$response = json_decode($rawResponse);
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
		if ((string) $request['id'] != (string) $response->id) {
			throw new Exception('Invalid response "id".');
		}
		if (isset($response->error) && is_object($response->error)) {
			if (isset($response->error->code) && $response->error->code == -10) {
				throw new Mmi_Json_Rpc_Data_Exception($response->error->message);
			}
			throw new Exception($response->error->message);
		}
		return $response->result;
	}
	
}
