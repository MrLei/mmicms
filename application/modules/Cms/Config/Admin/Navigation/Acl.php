<?php

namespace Cms\Config\Admin\Navigation;

class Acl extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Uprawnienia')
				->setModule('cms')
				->setController('admin-acl');
	}

}
