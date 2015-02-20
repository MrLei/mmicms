<?php


namespace Cms\Model\Route;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $pattern;
	public $replace;
	public $default;
	public $order;
	public $active;

	public function save() {
		Core\Registry::$cache->remove('\Mmi\Route');
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
