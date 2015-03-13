<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Core\Model\Changelog;

/**
 * Rekord incrementala bazy danych
 */
class Record extends \Mmi\Dao\Record {

	public $filename;
	public $md5;

}
