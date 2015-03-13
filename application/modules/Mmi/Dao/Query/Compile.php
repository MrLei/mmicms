<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao\Query;

class Compile {

	/**
	 * Część FROM zapytania
	 * @var string
	 */
	public $from;

	/**
	 * Część WHERE zapytania
	 * @var string
	 */
	public $where;

	/**
	 * Część ORDER zapytania
	 * @var string
	 */
	public $order = '';

	/**
	 * Tablica wartości where dla PDO::prepare()
	 * @see PDO::prepare()
	 * @var array
	 */
	public $bind = array();

	/**
	 * Limit
	 * @var int
	 */
	public $limit;

	/**
	 * Offset
	 * @var int
	 */
	public $offset;

	/**
	 * Schemat połączeńs
	 * @var array
	 */
	public $joinSchema = array();

}
