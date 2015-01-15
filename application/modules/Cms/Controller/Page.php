<?php

class Cms_Controller_Page extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->id || null === ($page = Cms_Model_Page_Dao::activeByIdQuery($this->id)->findFirst())) {
			$this->_helper->redirector('index', 'error', 'default', array(), true);
		}
		/* @var $page Cms_Model_Page_Record */
		$this->view->content = $page->text;
	}
	
}