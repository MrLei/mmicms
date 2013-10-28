<?php

class Cms_Model_Cache {
	
	public static function load($key) {
		if (!self::_isActive()) {
			return;
		}
		return MmiCar_Cache_Front::load($key);
	}
	
	public static function save($data, $key, $lifeTime = 360) {
		if (!self::_isActive()) {
			return;
		}
		MmiCar_Cache_Front::save($data, $key, $lifeTime);
	}
	
	public static function remove($key) {
		if (!self::_isActive()) {
			return;
		}
		MmiCar_Cache_Front::remove($key);
	}
	
	protected static function _isActive() {
		return isset(Mmi_Config::$data['cache']['active']) ? Mmi_Config::$data['cache']['active'] : false;
	}
	
}