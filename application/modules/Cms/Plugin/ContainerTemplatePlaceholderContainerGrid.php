<?php

class Cms_Plugin_ContainerTemplatePlaceholderContainerGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Container_Template_Placeholder_Container_Dao';

	public function init() {
		$container = Cms_Model_Container_Dao::findPk($this->_request->containerId);
		$options = Cms_Model_Container_Template_Placeholder_Dao::findPairs('id', 'name', array('cms_container_template_id', $container->cms_container_template_id));

		$this->addColumn('select', 'cms_container_template_placeholder_id', array(
			'multiOptions' => $options,
			'label' => 'placeholder',
		));

		$this->addColumn('text', 'module', array(
			'label' => 'nazwa modułu',
		));

		$this->addColumn('text', 'controller', array(
			'label' => 'nazwa kontrolera',
		));

		$this->addColumn('text', 'controller', array(
			'label' => 'nazwa akcji',
		));

		$this->addColumn('text', 'params', array(
			'label' => 'parametry',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'edit', 'controller' => 'adminContainerTemplatePlaceholderContainer' , 'containerId' => $this->_request->containerId)),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'delete', 'controller' => 'adminContainerTemplatePlaceholderContainer')),
			)
		));

	}

}