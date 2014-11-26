<?php

class Cms_Model_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container';

	public static function findFirstByUri($uri) {
		$q = self::newQuery()
				->where('uri')->equals($uri);
		$container = self::findFirst($q);
		if ($container === null) {
			return null;
		}
		$template = Cms_Model_Container_Template_Dao::findPk($container->cms_container_template_id);
		if ($template === null) {
			return null;
		}
		$container->setOption('placeholders', Cms_Model_Container_Template_Placeholder_Container_Dao::findByContainerId($container->id));
		$container->setOption('template', $template);
		return $container;
	}

}
