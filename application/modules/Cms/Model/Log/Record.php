<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Log;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $url;
	public $ip;
	public $browser;
	public $operation;
	public $object;
	public $objectId;
	public $data;
	public $success;
	public $cmsAuthId;
	public $dateTime;

}
