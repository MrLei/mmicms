<?php


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
		$form = new \Cms\Form\Comment(null, array(
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
