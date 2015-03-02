<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
