<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Contact extends \Mmi\Controller\Action {

	public function indexAction() {
		$namespace = new \Mmi\Session\Space('contact');
		$form = new \Cms\Form\Contact(null, array(
			'subjectId' => $this->subjectId
		));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Wiadomość wysłano poprawnie.', true);
			if ($namespace->referer) {
				$link = $namespace->referer;
			} else {
				$link = $this->view->url();
			}
			$namespace->unsetAll();
			$this->_helper->redirector()->gotoUrl($link);
		} elseif (\Mmi\Controller\Front::getInstance()->getEnvironment()->httpReferer) {
			$namespace->referer = \Mmi\Controller\Front::getInstance()->getEnvironment()->httpReferer;
		}
	}

}
