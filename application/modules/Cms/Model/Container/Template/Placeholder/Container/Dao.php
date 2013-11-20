<?php

class Cms_Model_Container_Template_Placeholder_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container_template_placeholder_container';
	protected static $_templateJoinSchema = array(
		'cms_container_template_placeholder' => array('id', 'cms_container_template_placeholder_id'),
		'cms_container_template' => array('id', 'cms_container_template_id', 'cms_container_template_placeholder'),
	);

	public static function findByContainerId($containerId) {
		$q = self::newQuery()
			->join('cms_container_template_placeholder')->on('cms_container_template_placeholder_id')
			->join('cms_container_template', 'cms_container_template_placeholder')->on('cms_container_template_id')
			->where('cms_container_id')->eqals($containerId);
		return self::find($q);
	}

}