<?php

namespace Cms\Config\Admin\Navigation;

class Comment extends \Mmi\Navigation\Config {

	public static function getMenu() {
		return self::newElement()
				->setLabel('Komentarze')
				->setModule('cms')
				->setController('admin-comment');
	}

}
