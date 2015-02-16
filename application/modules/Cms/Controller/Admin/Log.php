<?php

class Cms_Controller_AdminLog extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cms_Plugin_LogGrid();
		$this->view->grid = $grid;
	}

}
