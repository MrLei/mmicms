<?php

class Cms_Controller_Comment extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->object) {
			return;
		}
		if (!$this->objectId) {
			return;
		}
		$this->view->comments = Cms_Model_Comment_Dao::byObjectQuery($this->object, $this->objectId, $this->descending)
			->limit(100)
			->find();

		if (!($this->allowGuests || Default_Registry::$auth->hasIdentity())) {
			return;
		}
		$form = new Cms_Form_Comment(null, array(
			'object' => $this->object,
			'objectId' => $this->objectId,
			'withRatings' => ($this->withRatings) ? $this->withRatings : false,
		));
		if ($form->isSaved()) {
			$this->_helper->messenger('Dodano komentarz', true);
			$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
		}
	}

}
