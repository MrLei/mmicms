<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Dao/Query/Compile.php
 * @category   Mmi
 * @package    \Mmi\Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa skompilowanego zapytania
 * @category   Mmi
 * @package    \Mmi\Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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