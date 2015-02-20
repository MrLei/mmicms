<?php


namespace Cms\Controller;

class Article extends \Mmi\Controller\Action {

	public function indexAction() {
		//po uri
		if ($this->uri) {
			$uri = $this->uri;
			$cacheKey = 'Cms-Article-' . $uri;
			//po id
		} else {
			$id = intval($this->id);
			$cacheKey = 'Cms-Article-' . $id;
		}
		if (null === ($article = \Core\Registry::$cache->load($cacheKey))) {
			if (isset($uri)) {
				$article = \Cms\Model\Article\Dao::byUriQuery($uri)->findFirst();
			} else {
				$article = \Cms\Model\Article\Dao::findPk($id);
			}
			if ($article === null) {
				$this->_helper->redirector('index', 'index', 'core', array(), true);
			}
			\Core\Registry::$cache->save($article, $cacheKey, 28800);
		}
		if ($article->noindex) {
			$this->view->headMeta(array('name' => 'robots', 'content' => 'noindex,nofollow'));
		}
		$this->view->article = $article;
		$this->view->navigation()->modifyLastBreadcrumb(strip_tags($article->title), $this->view->url(), strip_tags($article->title), strip_tags($article->title . ', ' . mb_substr(strip_tags($article->text), 0, 150) . '...'));
	}

	public function widgetAction() {
		$uri = $this->uri;
		$cacheKey = 'Cms-Article-' . $uri;
		if (null === ($article = \Core\Registry::$cache->load($cacheKey))) {
			$article = \Cms\Model\Article\Dao::byUriQuery($uri)
				->findFirst();
			\Core\Registry::$cache->save($article, $cacheKey, 28800);
		}
		$this->view->article = $article;
	}

}
