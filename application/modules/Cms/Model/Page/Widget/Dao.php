<?php


namespace Cms\Model\Page\Widget;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_page_widget';
	
	public static function activeQuery() {
		return Cms\Model\Page\Widget\Query::factory()
			->whereActive()->equals(true);
	}
	
}