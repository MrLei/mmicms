<?php

namespace Cms\Controller;

class Page extends \Mmi\Controller\Action {

	public function indexAction() {
		if (!$this->id || null === ($page = \Cms\Model\Page\Dao::findFirstById($this->id))) {
			$this->_helper->redirector('index', 'error', 'default', array(), true);
		}
		/* @var $page \Cms\Model\Page\Record */
		$this->view->content = $page->text;
	}

}
