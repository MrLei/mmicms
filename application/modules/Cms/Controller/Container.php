<?php

class Cms_Controller_Container extends Mmi_Controller_Action {

	//@TODO: do usunięcia
	public function indexAction() {
		//po uri
		if (!$this->_getParam('uri')) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$cacheKey = 'Cms_Container_' . $this->_getParam('uri');
		if (null === ($container = Default_Registry::$cache->load($cacheKey))) {
			$container = Cms_Model_Container_Dao::findFirstByUri($this->_getParam('uri'));
			if ($container === null) {
				$this->_helper->redirector('index', 'index', 'default', array(), true);
			}
			Default_Registry::$cache->save($container, $cacheKey, 28800);
		}
		$this->view->container = $container;
		//$this->view->navigation()->modifyLastBreadcrumb($container->title, $this->view->url());
	}

	public function displayAction() {
		if (!$this->_getParam('uri')) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$container = Cms_Model_Container_Dao::findFirstByUri($this->_getParam('uri'));
		if ($container === null) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$action = new Mmi_Controller_Action_Helper_Action();
		foreach ($container->placeholders as $placeholder) {
			$params = array();
			parse_str($placeholder->params, $params);
			$content = $action->action($placeholder->module, $placeholder->controller, $placeholder->action, $params, true);
			Mmi_Controller_Front::getInstance()->getView()->setPlaceholder($placeholder->cms_container_template_placeholder->placeholder, $content);
		}
		Mmi_Controller_Front::getInstance()->getView()->render($container->template->path);
		Mmi_Controller_Front::getInstance()->getView()->setLayoutDisabled();
	}

}
