<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Page\Widget;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_page_widget';

	public static function activeQuery() {
		return \Cms\Model\Page\Widget\Query::factory()
				->whereActive()->equals(true);
	}

}
