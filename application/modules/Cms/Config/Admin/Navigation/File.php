<?php

class Cms_Config_Admin_Navigation_File extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Pliki')
				->setModule('cms')
				->setController('admin-file');
	}

}
