<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Stat\Date;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $hour;
	public $day;
	public $month;
	public $year;
	public $object;
	public $objectId;
	public $count;

}
