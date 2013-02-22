<?php

class Cms_Controller_Comment extends Mmi_Controller_Action {

	public function indexAction() {
		if (!$this->_getParam('object')) {
			return;
		}
		if (!$this->_getParam('objectId')) {
			return;
		}
		if ($this->_getParam('nolayout') == 1) {
			$this->view->setLayoutDisabled();
		}
		
		$withRatings = ($this->_getParam('withRatings')) ? $this->_getParam('withRatings') : false;
		
		if ($this->_getParam('allowGuests') || Mmi_Auth::getInstance()->hasIdentity()) {
			$formName = $this->_getParam('object') . '-' . $this->_getParam('objectId');
			$this->view->formName = $formName . 'Form';
			$form = new Cms_Form_Comment(null, array(
					'name' => $formName . 'Form',
					'withRatings' => $withRatings,
					'submitLabel' => ''
				));
			if ($form->isSaved()) {
				$this->_helper->messenger('Dodano komentarz', true);
				$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
			}
		}
		$order = 'ASC';
		if ($this->_getParam('descending')) {
			$order = 'DESC';
		}
		$this->view->comments = Cms_Model_Comment_Dao::findByObject($this->_getParam('object'), $this->_getParam('objectId'), 100, 0, $order);
	}

}
