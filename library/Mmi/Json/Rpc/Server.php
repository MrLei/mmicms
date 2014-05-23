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
 * @package    Mmi_Json_Rpc_Server
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Serwer JSON-RPC
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Json_Rpc_Server {

	/**
	 * Obsługa serwera
	 * @param string $className nazwa klasy
	 * @return boolean 
	 */
	public function handle($className) {

		//sprawdzanie czy dane które przyszły to json
		$contentType = Mmi_Controller_Front::getInstance()->getEnvironment()->contentType;
		if ($contentType != 'application/json') {
			die(json_encode(array(
				'id' => null,
				'result' => null,
				'error' => 'Invalid content-type ("application/json") required'
			)));
		}

		//wczytywanie danych
		$request = json_decode(file_get_contents('php://input'), true);
		
		//brak id
		if (!isset($request['id'])) {
			die(json_encode(array(
				'id' => null,
				'result' => null,
				'error' => 'Missing request ("id")'
			)));
		}
		
		//filtrowanie nazwy metody
		$method = preg_replace('/[^\p{L}\p{N}]/u', '', $request['method']);

		//wykonanie metody
		try {
			$object = new $className();
			//nagłówek json
			header('Content-type: application/json');
			die(json_encode(array(
				'id' => $request['id'],
				'result' => call_user_func_array(array($object, $method), $request['params']),
				'error' => null
			)));
		//wykonanie nie powiodło się
		} catch (Exception $e) {
			//objekt i metoda istnieją, błąd parametrów
			if (isset($object) && is_object($object) && method_exists($object, $method)) {
				die(json_encode(array(
					'id' => $request['id'],
					'result' => null,
					'error' => 'Invalid parameter count (' . count($request['params']) . ') for method ("' . $method . '") or method failed'
				)));
			//brak metody w serwisie
			} elseif (isset($object)) {
				die(json_encode(array(
					'id' => $request['id'],
					'result' => null,
					'error' => 'Function ("' . $method . '") is not a valid method for this service'
				)));
			}
			die(json_encode(array(
				'id' => $request['id'],
				'result' => null,
				'error' => 'Invalid service address'
			)));
			return false;
		}
	}

}