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
 * Mmi/Json/Rpc/Response.php
 * @category   Mmi
 * @package    Mmi_Json_Rpc
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Obiekt odpowiedzi JSON-RPC
 * @category   Mmi
 * @package    Mmi_Json_Rpc
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Json_Rpc_Response {

	/**
	 * Wersja JSON-RPC
	 * @var string
	 */
	public $jsonrpc = '2.0';
	
	/**
	 * Rezultat
	 * @var string 
	 */
	public $result;
	
	/**
	 * Błąd
	 * @var string
	 */
	public $error;
	
	/**
	 * ID odpowiedzi
	 * @var integer
	 */
	public $id;
	
	/**
	 * Konwersja do JSON'a
	 * @return string
	 */
	public function toJson() {
		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = $value;
		}
		return json_encode($data);
	}

}
