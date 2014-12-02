<?php

class Cms_Model_Container_Template_Placeholder_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder_container';

	public static function findByContainerId($containerId) {
		return Cms_Model_Container_Template_Placeholder_Container_Query::factory()
				->join('cms_container_template_placeholder')->on('cms_container_template_placeholder_id')
				->join('cms_container_template', 'cms_container_template_placeholder')->on('cms_container_template_id')
				->whereCmsContainerId()->equals($containerId)
				->find();
	}

}
