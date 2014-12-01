<?php

class Cms_Plugin_ContainerTemplatePlaceholderGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Container_Template_Placeholder_Dao';

	public function init() {
		$this->addColumn('text', 'name', array(
			'label' => 'nazwa placeholdera',
		));

		$this->addColumn('text', 'placeholder', array(
			'label' => 'klucz w szablonie',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'edit', 'controller' => 'adminContainerTemplatePlaceholder', 'templateId' => $this->_request->templateId)),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'delete', 'controller' => 'adminContainerTemplatePlaceholder')),
			)
		));
	}

}
