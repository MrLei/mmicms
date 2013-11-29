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
 * Mmi/Json/Rpc/Client.php
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Client
 * @copyright  Copyright (c) 2011 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klient JSON-RPC
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Client
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
			throw new Exception('Incorrect method name');
		}

		//sprawdzenie parametrów
		if (!is_array($params)) {
			$params = array();
		}

		//przygotowanie żądania
		$request = array(
			'method' => $method,
			'params' => array_values($params),
			'id' => (microtime(true) * 10000)
		);

		//pobieranie odpowiedzi z serwera
		try {
			$response = json_decode(file_get_contents($this->_url, false, stream_context_create(array('http' => array(
				'method' => 'PUT',
				'header' => array('Content-type: application/json', 'Connection: close'),
				'content' => json_encode($request)
			)))));
		} catch (Exception $e) {
			throw new Exception('Service unavailable or access denied');
		}
		if (!is_object($response) || !property_exists($response, 'result') || !isset($response->id)) {
			throw new Exception('Service error');
		}
		if ((string)$request['id'] != (string)$response->id) {
			throw new Exception('Invalid response ("id")');
		}
		if (isset($response->error)) {
			throw new Exception($response->error);
		}

		return $response->result;
	}

}