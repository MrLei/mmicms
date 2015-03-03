<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Mail\Definition;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $lang;
	public $cmsMailServerId;
	public $name;
	public $replyTo;
	public $fromName;
	public $subject;
	public $message;
	public $html;
	public $dateAdd;
	public $dateModify;
	public $active;

	protected function _update() {
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::_update();
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}
