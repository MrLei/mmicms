<?php

class Cms_Controller_Container extends Mmi_Controller_Action {

	public function indexAction() {
		//po uri
		if (!$this->_getParam('uri')) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$cacheKey = 'Cms_Container_' . $this->_getParam('uri');
		if (!($container = Mmi_Cache::load($cacheKey))) {
			$container = Cms_Model_Container_Dao::findFirst(array('uri', $this->_getParam('uri')));
			if ($container === null) {
				$this->_helper->redirector('index', 'index', 'default', array(), true);
			}
			Mmi_Cache::save($container, $cacheKey, 28800);
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
			Mmi_View::getInstance()->setPlaceholder($placeholder->placeholder, $content);
		}
		Mmi_View::getInstance()->render($container->template->path);
		exit;
	}

}
