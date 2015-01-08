<?php

class Tutorial_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->hello = "Hello world!";

		$form = new Tutorial_Form_Transfer();
		if ($form->isMine()) {
			return $this->_helper->redirector('simpleForm', 'index', 'tutorial', array(), true);
		}
	}

	public function simpleFormAction() {
		$form = new Tutorial_Form_Test();
		$this->view->items = Tutorial_Model_Query::factory()->find()->toArray();
		if ($form->isSaved()) {
			return $this->_helper->redirector('thankYou', 'index', 'tutorial', array(), true);
		}
	}

	public function thankYouAction() {
		
	}

}
