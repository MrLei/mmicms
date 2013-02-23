<?php

class Cms_Controller_Comment extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->_getParam('object')) {
			return;
		}
		if (!$this->_getParam('objectId')) {
			return;
		}
		$order = ($this->_getParam('descending')) ? 'DESC' : 'ASC';
		$this->view->comments = Cms_Model_Comment_Dao::findByObject($this->_getParam('object'), $this->_getParam('objectId'), 100, 0, $order);
		
		if (!($this->_getParam('allowGuests') || Mmi_Auth::getInstance()->hasIdentity())) {
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
