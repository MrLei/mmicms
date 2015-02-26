<?php

namespace Core\Config;

class Local extends App {

	public function __construct() {

		parent::__construct();

		$this->application->debug = true;
		$this->application->compile = false;
		$this->cache->active = true;
	}

}
