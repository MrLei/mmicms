<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Json\Rpc\Data;

/**
 * Klasa wyjątków danych serwera JSON-RPC
 */
class Exception extends \Exception {

	protected $code = -10;

}
