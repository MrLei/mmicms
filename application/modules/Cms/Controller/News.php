<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class News extends \Mmi\Controller\Action {

	public function indexAction() {
		//przekierowanie z posta z ilością podstron
		if ($this->getPost()->pages) {
			$this->getResponse()->redirect('cms', 'news', 'index', array('pages' => intval($this->getPost()->pages)));
		}
		$paginator = new \Mmi\Paginator();
		$pages = 10;
		//ustawianie ilości stron na liście
		if ($this->pages) {
			if ($this->pages % 10 != 0) {
				$this->getResponse()->redirect('cms', 'news', 'index');
			}
			$pages = (int) $this->pages;
		}
		$paginator->setRowsPerPage($pages);
		$paginator->setRowsCount(\Cms\Model\News\Dao::activeQuery()->count());
		$this->view->news = \Cms\Model\News\Dao::activeQuery()
			->limit($paginator->getLimit())
			->offset($paginator->getOffset())
			->find();
		$this->view->paginator = $paginator;
	}

	public function topAction() {
		$limit = $this->limit ? intval($this->limit) : 5;
		$this->view->news = \Cms\Model\News\Dao::activeQuery()
			->limit($limit)
			->find();
	}

	public function displayAction() {
		$this->view->item = \Cms\Model\News\Dao::activeByUriQuery($this->uri)
			->findFirst();
		if ($this->view->item === null) {
			$this->getResponse()->redirect('cms', 'news', 'index');
		}
		$this->view->navigation()->modifyLastBreadcrumb($this->view->item->title, $this->view->url());
	}

}
