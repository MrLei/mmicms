<?php


namespace Cms\Controller\Admin;

class Log extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$grid = new \Cms\Plugin\LogGrid();
		$this->view->grid = $grid;
	}
	
	public function errorAction() {
		$logFile = TMP_PATH . '/log/error.execution.log';
		$this->view->data = nl2br(file_get_contents($logFile, 0, NULL, filesize($logFile) - 32000));
	}

}
