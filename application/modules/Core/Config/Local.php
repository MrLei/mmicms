<?php

/**
 * Klasa umożliwiająca lokalne nadpisanie konfiguracji
 */

namespace Core\Config;

class Local extends \Core\Config\App {

	public function __construct() {

		parent::__construct();
		
		//domyślnie włączony debug i kompilacja + wyłączenie cache
		$this->application->debug = true;
		$this->application->compile = true;
		$this->cache->active = false;
	}

}
