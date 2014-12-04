<?php

class Mail_Model_Definition_Dao extends Mmi_Dao {

	protected static $_tableName = 'mail_definition';

	/**
	 * 
	 * @return Mail_Model_Definition_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Mail_Model_Definition_Query::factory();
		}
		return Mail_Model_Definition_Query::factory()
			->andQuery(Mail_Model_Definition_Query::factory()
				->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
				->orFieldLang()->equals(null)
				->orderDescLang()
		);
	}
	
	/**
	 * 
	 * @param string $name
	 * @return Mail_Model_Definition_Query
	 */
	public static function langByNameQuery($name) {
		return self::langQuery()
			->whereName()->equals($name);
	}

}
