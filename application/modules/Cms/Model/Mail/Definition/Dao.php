<?php

class Cms_Model_Mail_Definition_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_definition';

	/**
	 * 
	 * @return Cms_Model_Mail_Definition_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Cms_Model_Mail_Definition_Query::factory();
		}
		return Cms_Model_Mail_Definition_Query::factory()
			->andQuery(Cms_Model_Mail_Definition_Query::factory()
				->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
				->orFieldLang()->equals(null)
				->orderDescLang()
		);
	}
	
	/**
	 * 
	 * @param string $name
	 * @return Cms_Model_Mail_Definition_Query
	 */
	public static function langByNameQuery($name) {
		return self::langQuery()
			->whereName()->equals($name);
	}

}
