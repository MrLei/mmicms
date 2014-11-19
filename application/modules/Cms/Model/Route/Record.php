<?php

class Cms_Model_Route_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $pattern;

	/**
	 *
	 * @var string
	 */
	public $replace;

	/**
	 *
	 * @var string
	 */
	public $default;

	/**
	 *
	 * @var integer
	 */
	public $order;

	/**
	 *
	 * @var integer
	 */
	public $active;

	public function save() {
		Default_Registry::$cache->remove('Mmi_Route');
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
