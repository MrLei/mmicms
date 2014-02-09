<?php

class Cms_Controller_Comment extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->_getParam('object')) {
			return;
		}
		if (!$this->_getParam('objectId')) {
			return;
		}
		$this->view->comments = Cms_Model_Comment_Dao::findByObject($this->_getParam('object'), $this->_getParam('objectId'), $this->_getParam('descending'));
		
		if (!($this->_getParam('allowGuests') || Default_Registry::$auth->hasIdentity())) {
			return;
		}
		$form = new Cms_Form_Comment(null, array(
				'object' => $this->_getParam('object'),
				'objectId' => $this->_getParam('objectId'),
				'withRatings' => ($this->_getParam('withRatings')) ? $this->_getParam('withRatings') : false,
			));
		if ($form->isSaved()) {
			$this->_helper->messenger('Dodano komentarz', true);
			$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
		}
	}

}
