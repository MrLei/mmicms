<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Page extends \Mmi\Controller\Action {

	public function indexAction() {
		if (!$this->id || null === ($page = \Cms\Model\Page\Dao::findFirstById($this->id))) {
			$this->getResponse()->redirect('default', 'error', 'index');
		}
		/* @var $page \Cms\Model\Page\Record */
		$this->view->content = $page->text;
	}

}
