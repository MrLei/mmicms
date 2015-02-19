<?php

/**
 * Klasa konfiguracji nawigatora
 */
class Default_Config_Navigation extends Mmi_Navigation_Config {

	/**
	 * Konstruktor inicjujący konfigurację
	 */
	public function __construct() {
		//dodanie menu skonfigurowanego w module CMS
		$this->addElement(Cms_Config_Admin_Navigation::getMenu());
	}

}
