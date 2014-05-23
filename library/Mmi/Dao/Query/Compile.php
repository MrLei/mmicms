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
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa skompilowanego zapytania
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao_Query_Compile {
	
	/**
	 * Bind kompatybilny z Mmi_Db_Adapter_Pdo_Abstract
	 * @see Mmi_Db_Adapter_Pdo_Abstract
	 * @var array
	 */
	public $bind = array();
	
	/**
	 * Order kompatybilny z Mmi_Db_Adapter_Pdo_Abstract
	 * @see Mmi_Db_Adapter_Pdo_Abstract
	 * @var array
	 */
	public $order = array();

	/**
	 * Schemat połączeń kompatybilny z Mmi_Db_Adapter_Pdo_Abstract
	 * @see Mmi_Db_Adapter_Pdo_Abstract
	 * @var array
	 */
	public $joinSchema = array();

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
	
}