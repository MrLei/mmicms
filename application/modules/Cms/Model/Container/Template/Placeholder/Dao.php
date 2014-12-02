<?php

class Cms_Model_Container_Template_Placeholder_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder';

	public static function findPairsByTemplateId($keyName, $valueName, $templateId) {
		return Cms_Model_Container_Template_Placeholder_Query::factory()
				->whereCmsContainerTemplateId()->equals($templateId)
				->findPairs($keyName, $valueName);
	}

}
