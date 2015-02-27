<?php

namespace Cms\Model\Mail\Server;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $address;
	public $port;
	public $username;
	public $password;
	public $from;
	public $dateAdd;
	public $dateModify;
	public $active;
	public $ssl;

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}
