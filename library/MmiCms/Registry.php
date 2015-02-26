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
 * @package    MmiCms\Registry
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa rejestru CMS
 * @category   MmiCms
 * @package    MmiCms\Registry
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms;

abstract class Registry extends \Mmi\Registry {

	/**
	 * Obiekt ACL
	 * @var \Mmi\Acl
	 */
	public static $acl;

	/*
	 * Obiekt autoryzacji
	 * @var \Mmi\Auth
	 */
	public static $auth;

	/**
	 * Obiekt bufora
	 * @var \Mmi\Cache
	 */
	public static $cache;

	/**
	 * Obiekt adaptera bazodanowego
	 * @var \Mmi\Db\Adapter\Pdo\Abstract
	 */
	public static $db;

	/**
	 * Obiekt navigacji
	 * @var \Mmi\Navigation
	 */
	public static $navigation;

	/**
	 * Obiekt translacji
	 * @var \Mmi\Translate
	 */
	public static $translate;

}
