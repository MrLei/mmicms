<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Route;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $pattern;
	public $replace;
	public $default;
	public $order;
	public $active;

	public function save() {
		\Core\Registry::$cache->remove('\Mmi\Route');
		return parent::save();
	}

	public function toRouteArray() {
		$replace = array();
		$default = array();
		parse_str($this->replace, $replace);
		parse_str($this->default, $default);
		$route = array(
			'pattern' => $this->pattern,
			'replace' => $replace,
			'default' => $default
		);
		return $route;
	}

}
