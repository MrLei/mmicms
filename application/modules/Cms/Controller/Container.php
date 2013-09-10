<?php

class Cms_Controller_Container extends Mmi_Controller_Action {

	public function indexAction() {
		//po uri
		if (!$this->_getParam('uri')) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$cacheKey = 'Cms_Container_' . $this->_getParam('uri');
		if (!Mmi_Config::get('cache', 'active') || !($container = Mmi_Cache::getInstance()->load($cacheKey))) {
			$container = Cms_Model_Container_Dao::findFirst(array('uri', $this->_getParam('uri')));
			if ($container === null) {
				$this->_helper->redirector('index', 'index', 'default', array(), true);
			}
			Mmi_Cache::getInstance()->save($container, $cacheKey, 28800);
		}
		$this->view->container = $container;
		//$this->view->navigation()->modifyLastBreadcrumb($container->title, $this->view->url());
	}
	
}
