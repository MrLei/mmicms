<?php

namespace Cms\Model\Article;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $lang;
	public $title;
	public $uri;
	public $dateAdd;
	public $dateModify;
	public $text;
	public $noindex;

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$filter = new \Mmi\Filter\Url();
		$this->uri = $filter->filter(strip_tags($this->title));
		$result = parent::save();
		\Core\Registry::$cache->remove('Cms-Article-' . $this->uri);
		\Core\Registry::$cache->remove('Cms-Article-Image' . $this->id);
		return $result;
	}

	public function delete() {
		$article = \Cms\Model\Navigation\Dao::byArticleUriQuery($this->uri)
			->findFirst();
		if ($article !== null) {
			$article->delete();
		}
		return parent::delete();
	}

	public function getFirstImage() {
		$cacheKey = 'Cms-Article-Image-' . $this->id;
		if (null !== ($image = \Core\Registry::$cache->load($cacheKey))) {
			return $image;
		}
		$image = \Cms\Model\File\Dao::imagesByObjectQuery('cmsarticle', $this->id)->findFirst();
		\Core\Registry::$cache->save($image, $cacheKey, 3600);
		return $image;
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}
