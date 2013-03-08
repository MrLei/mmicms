<?php

class Cms_Controller_Article extends Mmi_Controller_Action {

	public function indexAction() {
		//po uri
		if ($this->_getParam('uri')) {
			$uri = $this->_getParam('uri');
			$cacheKey = 'Cms_Article_' . $uri;
		//po id
		} else {
			$id = intval($this->_getParam('id'));
			$cacheKey = 'Cms_Article_' . $id;
		}
		if (!Mmi_Config::get('cache', 'active') || null === ($article = Mmi_Cache::getInstance()->load($cacheKey))) {
			if (isset($uri)) {
				$article = Cms_Model_Article_Dao::findFirst(array('uri', $uri));
			} else {
				$article = Cms_Model_Article_Dao::findPk($id);
			}
			if ($article === null) {
				$this->_helper->redirector('index', 'index', 'default', array(), true);
			}
			Mmi_Cache::getInstance()->save($article, $cacheKey, 28800);
		}
		$this->view->article = $article;
		$this->view->navigation()->modifyLastBreadcrumb($article->title, $this->view->url(), $article->title, $article->title . ', ' . mb_substr(strip_tags($article->text), 0, 100));
	}
	
}
