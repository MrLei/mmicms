<?php

class Cms_Model_Container_Template_Placeholder_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder';

	public static function findPairsByTemplateId($keyName, $valueName, $templateId) {
		$q = self::newQuery()
				->where('cms_container_template_id')->eqals($templateId);
		return parent::findPairs($keyName, $valueName, $q);
	}

}
