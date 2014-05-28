<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * MmiCms/Registry.php
 * @category   MmiCms
 * @package    MmiCms_Registry
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa rejestru CMS
 * @category   MmiCms
 * @package    MmiCms_Registry
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
abstract class MmiCms_Registry extends Mmi_Registry {

	/**
	 * Obiekt ACL
	 * @var Mmi_Acl
	 */
	public static $acl;

	/*
	 * Obiekt autoryzacji
	 * @var Mmi_Auth
	 */
	public static $auth;

	/**
	 * Obiekt bufora
	 * @var Mmi_Cache
	 */
	public static $cache;

	/**
	 * Obiekt adaptera bazodanowego
	 * @var Mmi_Db_Adapter_Pdo_Abstract
	 */
	public static $db;

	/**
	 * Obiekt navigacji
	 * @var Mmi_Navigation
	 */
	public static $navigation;

	/**
	 * Obiekt translacji
	 * @var Mmi_Translate
	 */
	public static $translate;

}
