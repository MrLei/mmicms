<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Mail\Definition;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_mail_definition';

	/**
	 * 
	 * @return \Cms\Model\Mail\Definition\Query
	 */
	public static function langQuery() {
		if (!\Mmi\Controller\Front::getInstance()->getRequest()->lang) {
			return \Cms\Model\Mail\Definition\Query::factory();
		}
		return \Cms\Model\Mail\Definition\Query::factory()
				->andQuery(\Cms\Model\Mail\Definition\Query::factory()
					->whereLang()->equals(\Mmi\Controller\Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang()
		);
	}

	/**
	 * 
	 * @param string $name
	 * @return \Cms\Model\Mail\Definition\Query
	 */
	public static function langByNameQuery($name) {
		return self::langQuery()
				->whereName()->equals($name);
	}

}
