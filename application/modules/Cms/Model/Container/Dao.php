<?php

class Cms_Model_Container_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_container';

	public static function findFirstByUri($uri) {
		$container = Cms_Model_Container_Query::factory()
			->whereUri()->equals($uri)
			->findFirst();
		if ($container === null) {
			return null;
		}
		$template = Cms_Model_Container_Template_Dao::findPk($container->cmsContainerTemplateId);
		if ($template === null) {
			return null;
		}
		$container->setOption('placeholders', Cms_Model_Container_Template_Placeholder_Container_Dao::findByContainerId($container->id));
		$container->setOption('template', $template);
		return $container;
	}

}
