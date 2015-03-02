<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Router\Config;

class Route {

	/**
	 * Nazwa routy (unikalna)
	 * @var string
	 */
	public $name;

	/**
	 * Wyrażenie regularne, lub czysty tekst, np.:
	 * /^hit\/(.[^\/]+)/
	 * witaj/potwierdzenie
	 * @var string
	 */
	public $pattern;

	/**
	 * Tabela zastąpień, np.:
	 * array('module' => 'news', 'controller' => 'index', 'action' => 'index');
	 * @var array
	 */
	public $replace = array();

	/**
	 * Tabela wartości domyślnych, np.:
	 * array('lang' => 'pl');
	 * @var array
	 */
	public $default = array();

}
