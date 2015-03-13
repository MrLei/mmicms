<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Application;

class BootstrapCli extends \Cms\Application\Bootstrap {

	public function __construct() {

		parent::__construct();
	}

	/**
	 * Uruchamianie bootstrapa - brak front kontrolera
	 */
	public function run() {
		$front = \Mmi\Controller\Front::getInstance();
		$request = new \Mmi\Controller\Request();
		//ustawianie domyślnego języka jeśli istnieje
		if (isset(\Core\Registry::$config->application->languages[0])) {
			$request->lang = \Core\Registry::$config->application->languages[0];
		}
		$request->setModuleName('default')
			->setControllerName('index')
			->setActionName('index')
			->setSkinName(\Core\Registry::$config->application->skin);
		//ustawianie żądania
		$front->setRequest($request);
		\Mmi\Controller\Front::getInstance()->getView()->setRequest($request);
	}

}
