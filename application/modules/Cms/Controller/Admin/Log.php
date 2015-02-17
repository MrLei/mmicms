<?php

class Cms_Controller_Admin_Log extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cms_Plugin_LogGrid();
		$this->view->grid = $grid;
	}

}
