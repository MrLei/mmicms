<?php

class Cms_Controller_Admin_Log extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cms_Plugin_LogGrid();
		$this->view->grid = $grid;
	}
	
	public function errorAction() {
		$logFile = TMP_PATH . '/log/error.execution.log';
		$this->view->data = nl2br(file_get_contents($logFile, 0, NULL, filesize($logFile) - 32000));
	}

}
