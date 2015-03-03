<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Comment extends \Mmi\Controller\Action {

	public function indexAction() {
		if (!$this->object) {
			return;
		}
		if (!$this->objectId) {
			return;
		}
		$this->view->comments = \Cms\Model\Comment\Dao::byObjectQuery($this->object, $this->objectId, $this->descending)
			->limit(100)
			->find();

		if (!($this->allowGuests || \Core\Registry::$auth->hasIdentity())) {
			return;
		}
		$form = new \Cms\Form\Comment(new \Cms\Model\Comment\Record(), array(
			'object' => $this->object,
			'objectId' => $this->objectId,
			'withRatings' => ($this->withRatings) ? $this->withRatings : false,
		));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Dodano komentarz', true);
			$this->getResponse()->redirectToUrl($this->getRequest()->getReferer());
		}
	}

}
