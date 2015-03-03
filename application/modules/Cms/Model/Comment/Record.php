<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Comment;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $cmsAuthId;
	public $parentId;
	public $dateAdd;
	public $title;
	public $text;
	public $signature;
	public $ip;
	public $stars;
	public $object;
	public $objectId;

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$auth = \Core\Registry::$auth;
		if ($auth->hasIdentity()) {
			$this->signature = $auth->getUsername();
			$this->cmsAuthId = $auth->getId();
		} else {
			$this->signature = '~' . $this->signature;
			$this->ip = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		}
		return parent::_insert();
	}

}
