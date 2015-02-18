<?php

class Default_Config_Navigation extends Mmi_Navigation_Config {

	public function __construct() {
		$this->addElement(Cms_Config_Admin_Navigation::getMenu());
	}

}
