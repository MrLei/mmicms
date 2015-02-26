<?php

namespace Tutorial\Controller;

class Index extends \Mmi\Controller\Action {

	public function indexAction() {
		$this->view->hello = "Hello world!";

		$form = new Tutorial\Form\Transfer();
		if ($form->isMine()) {
			return $this->_helper->redirector('simpleForm', 'index', 'tutorial', array(), true);
		}
	}

	public function simpleFormAction() {
		$form = new Tutorial\Form\Test();
		$this->view->items = Tutorial\Model\Query::factory()->find()->toArray();
		if ($form->isSaved()) {
			return $this->_helper->redirector('thankYou', 'index', 'tutorial', array(), true);
		}
	}

	public function thankYouAction() {
		
	}

}
