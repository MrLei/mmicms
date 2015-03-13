<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

class File {
	
	public $name;
	
	public $tmpName;
	
	public $size;
	
	public $type;
	
	/**
	 * 
	 * @param array $data
	 */
	public function __construct(array $data) {
		//brak nazwy
		if (!isset($data['name'])) {
			throw new \Exception('\Mmi\Controller\Request\File: name not specified');
		}
		//brak tmp_name
		if (!isset($data['tmp_name'])) {
			throw new \Exception('\Mmi\Controller\Request\File: tmp_name not specified');
		}
		//brak rozmiaru
		if (!isset($data['size'])) {
			throw new \Exception('\Mmi\Controller\Request\File: size not specified');
		}
		$this->name = $data['name'];
		$this->type = \Mmi\Lib::mimeType($data['tmp_name']);
		$this->tmpName = $data['tmp_name'];
		$this->size = $data['size'];
	}
	
}