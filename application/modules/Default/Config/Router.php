<?php

class Default_Config_Router extends Mmi_Controller_Router_Config {

	public function __construct() {

		$this->setRoute(0, '', array('module' => 'default'), array('lang' => 'pl', 'controller' => 'index', 'action' => 'index'));
	}

}
