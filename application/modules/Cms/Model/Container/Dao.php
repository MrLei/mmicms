<?php

class Cms_Model_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container';

	public static function findFirstByUri($uri) {
		$container = self::findFirst(array('uri', $uri));
		if ($container === null) {
			return null;
		}
		$template = Cms_Model_Container_Template_Dao::findPk($container->cms_container_template_id);
		if ($template === null) {
			return null;
		}
		$container->placeholders = Cms_Model_Container_Template_Placeholder_Container_Dao::findByContainerId($container->id);
		$container->template = $template;
		return $container;
	}

}