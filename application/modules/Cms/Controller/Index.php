<?php

class Cms_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$this->_helper->redirector('index', 'admin', 'cms', array(), true);
	}

}
