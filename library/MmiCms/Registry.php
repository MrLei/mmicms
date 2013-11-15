<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Registry.php
 * @category   MmiCms
 * @package    MmiCms_Registry
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa rejestru CMS
 * @category   MmiCms
 * @package    MmiCms_Registry
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
