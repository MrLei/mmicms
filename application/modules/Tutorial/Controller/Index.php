<?php

namespace Tutorial\Controller;

class Index extends \Mmi\Controller\Action {

	public function indexAction() {
		$this->view->hello = "Hello world!";

		$form = new Tutorial\Form\Transfer();
		if ($form->isMine()) {
			$this->getResponse()->redirect('tutorial', 'index', 'simpleForm');
		}
	}

	public function simpleFormAction() {
		$form = new Tutorial\Form\Test();
		$this->view->items = Tutorial\Model\Query::factory()->find()->toArray();
		if ($form->isSaved()) {
			$this->getResponse()->redirect('tutorial', 'index', 'thankYou');
		}
	}

	public function thankYouAction() {
		
	}

}
