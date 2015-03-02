<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Application;

class Config {

	/**
	 * Charset
	 * @var string
	 */
	public $charset = 'utf-8';

	/**
	 * Tryb debugowania
	 * @var boolean
	 */
	public $debug = false;

	/**
	 * Bezwarunkowa kompilacja
	 * @var boolean
	 */
	public $compile = true;

	/**
	 * Strefa czasowa
	 * @var string
	 */
	public $timeZone = 'Europe/Warsaw';

	/**
	 * Nazwa skóry
	 * @var string
	 */
	public $skin = 'default';

	/**
	 * Globalna sól aplikacji
	 * @var string
	 */
	public $salt = 'change-this-value';

	/**
	 * Języki obsługiwane przez aplikację
	 * np. pl, en, fr
	 * @var array
	 */
	public $languages = array();

	/**
	 * Pluginy włączone w aplikacji
	 * np. MmiTest\Controller\Plugin
	 * @var array
	 */
	public $plugins = array();

	/**
	 * Domyślny host, jeśli nie ustawiony
	 * @var string
	 */
	public $host;

}
