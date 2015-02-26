<?php

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
