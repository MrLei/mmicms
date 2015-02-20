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
 * @package    \Mmi\Json\Rpc
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Obiekt odpowiedzi JSON-RPC
 * @category   Mmi
 * @package    \Mmi\Json\Rpc
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Json\Rpc;

class Response {

	/**
	 * Wersja JSON-RPC
	 * @var string
	 */
	public $jsonrpc = '2.0';

	/**
	 * ID odpowiedzi
	 * @var integer
	 */
	public $id;

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
	 * Ustawia obiekt na podstawie JSON'a
	 * @param string $data
	 * @return \Mmi\Json\Rpc\Response
	 */
	public function setFromJson($data) {
		$response = json_decode($data);
		$this->jsonrpc = isset($response->jsonrpc) ? $response->jsonrpc : null;
		$this->id = isset($response->id) ? $response->id : null;
		$this->result = isset($response->result) ? $response->result : null;
		$this->error = isset($response->error) ? $response->error : null;
		return $this;
	}
	
	/**
	 * Konwersja do JSON'a
	 * @return string
	 */
	public function toJson() {
		return json_encode($this);
	}

}
