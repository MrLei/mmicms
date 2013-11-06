<?php

class Cms_Model_Container_Template_Placeholder_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder_container';
	protected static $_templateJoinSchema = array(
		'cms_container_template_placeholder' => array('id', 'cms_container_template_placeholder_id'),
		'cms_container_template' => array('id', 'cms_container_template_id', 'cms_container_template_placeholder'),
	);
	
	public static function findByContainerId($containerId) {
		return self::find(array(
			array('cms_container_id', $containerId)
		), array(), null, null, self::$_templateJoinSchema);
	}

}