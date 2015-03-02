<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Application;

interface BootstrapInterface {

	/**
	 * Parametryzowanie bootstrapa
	 */
	public function __construct();

	/**
	 * Uruchomienie bootstrapa
	 */
	public function run();
}
