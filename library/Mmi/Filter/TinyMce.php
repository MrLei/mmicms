<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Filter;

class TinyMce extends \Mmi\Filter\FilterAbstract {

	/**
	 * Filtruje zmienne tak by były poprawnie przekazywane przez GET
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		return strip_tags($value, '<img><em><b><strong><u><p><a><br><ul><ol><hr><table><th><tbody><thead><tr><td><li><span><div><h1><h2><h3><h4><h5><h6><sup><sub><iframe><code>');
	}

}
