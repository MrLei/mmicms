<?php

class Cms_Controller_Contact extends Mmi_Controller_Action {

	public function indexAction() {
		$namespace = new Mmi_Session_Namespace('contact');
		$form = new Cms_Form_Contact(null, array(
			'subjectId' => $this->_getParam('subjectId')
		));
		if ($form->isSaved()) {
			$this->_helper->messenger('Wiadomość wysłano poprawnie.', true);
			if ($namespace->referer) {
				$link = $namespace->referer;
			} else {
				$link = $this->view->url();
			}
			$namespace->unsetAll();
			$this->_helper->redirector()->gotoUrl($link);
		} elseif(Mmi_Controller_Front::getInstance()->getEnvironment()->httpReferer)  {
			$namespace->referer =  Mmi_Controller_Front::getInstance()->getEnvironment()->httpReferer;
		}
	}

}
