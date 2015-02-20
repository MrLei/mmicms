<?php

/**
 * Klasa konfiguracji nawigatora
 */

namespace Core\Config;

class Navigation extends \Mmi\Navigation\Config {

	/**
	 * Konstruktor inicjujący konfigurację
	 */
	public function __construct() {
		//dodanie menu skonfigurowanego w module CMS
		$this->addElement(\Cms\Config\Admin\Navigation::getMenu());
	}

}
