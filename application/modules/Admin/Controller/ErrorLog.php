<?php

class Admin_Controller_ErrorLog extends MmiCms_Controller_Admin {

	public function indexAction() {
		$model = new Admin_Model_ErrorLog();
		$this->view->data = $model->getContent();
	}

}
