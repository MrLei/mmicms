<?php

class Cms_Controller_AdminPage extends MmiCms_Controller_Admin {

	public function indexAction() {
		
	}
	
	public function editAction() {
		$form = new Cms_Form_Admin_Page_Edit();
		if ($form->isSaved()) {
			
		}
	}
	
	public function deleteAction() {
		
	}
	
}