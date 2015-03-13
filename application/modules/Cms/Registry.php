<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms;

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
	 * @var \Mmi\Db\Adapter\Pdo\PdoAbstract
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
	
	/**
	 * Konfiguracja
	 * @var \Core\Config\Local
	 */
	public static $config;

}
