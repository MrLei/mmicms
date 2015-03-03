<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Stat\Label;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $lang;
	public $object;
	public $label;
	public $description;

	protected function _insert() {
		$this->lang = \Mmi\Controller\Front::getInstance()->getRequest()->lang;
		return parent::_insert();
	}

}
