<?php

namespace Cms\Config\Admin\Navigation;

class File extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Pliki')
				->setModule('cms')
				->setController('admin-file');
	}

}
