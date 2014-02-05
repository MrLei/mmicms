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
 * Mmi/Json/Rpc/Server.php
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Serwer JSON-RPC
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Json_Rpc_Server {

	/**
	 * Obsługa serwera
	 * @param string $className nazwa klasy
	 * @return boolean 
	 */
	public function handle($className) {

		//sprawdzanie czy dane które przyszły to json
		if (!isset($_SERVER['CONTENT_TYPE']) || $_SERVER['CONTENT_TYPE'] != 'application/json') {
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