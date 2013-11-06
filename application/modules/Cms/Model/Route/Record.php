<?php

class Cms_Model_Route_Record extends Mmi_Dao_Record {

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