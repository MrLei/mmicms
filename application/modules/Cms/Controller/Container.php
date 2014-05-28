<?php

class Cms_Controller_Container extends Mmi_Controller_Action {

	public function displayAction() {
		if (!$this->_getParam('uri')) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$container = Cms_Model_Container_Dao::findFirstByUri($this->_getParam('uri'));
		if ($container === null) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$action = new Mmi_Controller_Action_Helper_Action();
		foreach ($container->placeholders as $placeholder) { /* @var $placeholder Cms_Model_Container_Template_Placeholder_Container_Record */
			$params = array();
			
			parse_str($placeholder->params, $params);
			$content = $action->action($placeholder->module, $placeholder->controller, $placeholder->action, $params, true);
			$package = '<div style="margin:';
			$package .= ' ' . ($placeholder->marginTop ? $placeholder->marginTop : 0);
			$package .= 'px ' . ($placeholder->marginRight ? $placeholder->marginRight : 0);
			$package .= 'px ' . ($placeholder->marginBottom ? $placeholder->marginBottom : 0);
			$package .= 'px ' . ($placeholder->marginLeft ? $placeholder->marginLeft : 0);
			$package .= 'px">';
			$content = $package . $content . '</div>';
			$this->view->setPlaceholder($placeholder->cms_container_template_placeholder->placeholder, '<div>' . $content . '</div>');
		}
		$this->view->render($container->template->path);
		$this->view->setLayoutDisabled();
	}

}
