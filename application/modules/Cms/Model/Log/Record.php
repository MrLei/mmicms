<?php

class Cms_Model_Log_Record extends Mmi_Dao_Record {

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
