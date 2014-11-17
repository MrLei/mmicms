<?php

class Cms_Controller_Article extends Mmi_Controller_Action {

	public function indexAction() {
		//po uri
		if ($this->uri) {
			$uri = $this->uri;
			$cacheKey = 'Cms_Article_' . $uri;
		//po id
		} else {
			$id = intval($this->id);
			$cacheKey = 'Cms_Article_' . $id;
		}
		if (null === ($article = Default_Registry::$cache->load($cacheKey))) {
			if (isset($uri)) {
				$article = Cms_Model_Article_Dao::findFirstByUri($uri);
			} else {
				$article = Cms_Model_Article_Dao::findPk($id);
			}
			if ($article === null) {
				$this->_helper->redirector('index', 'index', 'default', array(), true);
			}
			Default_Registry::$cache->save($article, $cacheKey, 28800);
		}
		if ($article->noindex) {
			$this->view->headMeta(array('name' => 'robots', 'content' => 'noindex,nofollow'));
		}
		$this->view->article = $article;
		$this->view->navigation()->modifyLastBreadcrumb(strip_tags($article->title), $this->view->url(), strip_tags($article->title), strip_tags($article->title . ', ' . mb_substr(strip_tags($article->text), 0, 150) . '...'));
	}

	public function widgetAction() {
		$uri = $this->uri;
		$cacheKey = 'Cms_Article_' . $uri;
		if (null === ($article = Default_Registry::$cache->load($cacheKey))) {
			$article = Cms_Model_Article_Dao::findFirstByUri($uri);
			Default_Registry::$cache->save($article, $cacheKey, 28800);
		}
		$this->view->article = $article;
	}

}
