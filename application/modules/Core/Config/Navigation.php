<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
