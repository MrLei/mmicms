<?php

class Cms_Model_Container_Template_Placeholder_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder';
	
	public static function findPairsByTemplateId($keyName, $valueName, $templateId) {
		$q = self::getNewQuery();
		$q->andField('cms_container_template_id')->equals($templateId);
		parent::findPairs($keyName, $valueName, $q);
	}

}