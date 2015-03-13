<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

class Post extends \Mmi\DataObject {
	
	/**
	 * Konstruktor
	 * @param array $post dane z POST
	 */
	public function __construct(array $post = array()) {
		$this->_data = $post;
	}
	
}