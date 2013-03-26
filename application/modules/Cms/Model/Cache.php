<?php

class Cms_Model_Cache {
	
	public static function load($key) {
		if (!self::_isActive()) {
			return;
		}
		return Mmi_Cache::getInstance()->load($key);
	}
	
	public static function save($data, $key, $lifeTime = 360) {
		if (!self::_isActive()) {
			return;
		}
		Mmi_Cache::getInstance()->save($data, $key, $lifeTime);
	}
	
	public static function remove($key) {
		if (!self::_isActive()) {
			return;
		}
		Mmi_Cache::getInstance()->remove($key);
	}
	
	protected static function _isActive() {
		return isset(Mmi_Config::$data['cache']['active']) ? Mmi_Config::$data['cache']['active'] : false;
	}
	
}