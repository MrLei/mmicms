<?php

class Cms_Config_Admin_Navigation_Comment extends Mmi_Navigation_Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Komentarze')
				->setModule('cms')
				->setController('admin-comment');
	}

}
