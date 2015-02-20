<?php


namespace Cms\Model\Tag;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_tag';
	
	public static function byNameQuery($tagName) {
		return Cms\Model\Tag\Query::factory()
				->whereTag()->equals($tagName);
	}

}
