<?php

class Admin_Controller_ErrorLog extends MmiCms_Controller_Admin {

	public function indexAction() {
		$model = new Admin_Model_ErrorLog();
		$this->view->data = $model->getContent();
	}

	public function traceAction() {
		$form = new Admin_Form_Trace();
		if ($form->isMine()) {
			try {
				$this->view->trace = unserialize(Mmi_Lib::decrypt($form->getValue('trace'), 'dce'));
			} catch (Exception $e) {
				$this->_helper->messenger('Kod jest niepoprawny', false);
				$this->_helper->redirector('trace');
			}
		}
	}

}
