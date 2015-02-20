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
 * Mmi/Json/Rpc/Request.php
 * @category   Mmi
 * @package    \Mmi\Json\Rpc
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Obiekt żądania JSON-RPC
 * @category   Mmi
 * @package    \Mmi\Json\Rpc
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Json\Rpc;

class Request {
	
	/**
	 * Wersja JSON-RPC
	 * @var string
	 */
	public $jsonrpc;

	/**
	 * ID odpowiedzi
	 * @var integer
	 */
	public $id;

	/**
	 * Nazwa metody
	 * @var string 
	 */
	public $method;
	
	/**
	 * Parametry
	 * @var array
	 */
	public $params = array();
	
	/**
	 * Ustawia na podstawie tablicy
	 * @param array $data
	 */
	public function setFromArray(array $data) {
		$this->jsonrpc = isset($data['jsonrpc']) ? $data['jsonrpc'] : null;
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->method = isset($data['method']) ? $data['method'] : null;
		$this->params = (isset($data['params']) && is_array($data['params'])) ? $data['params'] : array();
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