<?php

class Cms_Model_Article_Record extends Mmi_Dao_Record {

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$filter = new Mmi_Filter_Url();
		$this->uri = $filter->filter(strip_tags($this->title));
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$result = parent::save();
		Default_Registry::$cache->remove('Cms_Article_' . $this->uri);
		Default_Registry::$cache->remove('Cms_article_image' . $this->id);
		return $result;
	}

	public function delete() {
		$article = Cms_Model_Navigation_Dao::findFirstByArticleUri($this->uri);
		if ($article !== null) {
			$article->delete();
		}
		return parent::delete();
	}

	public function getFirstImage() {
		$cacheKey = 'Cms_article_image_' . $this->id;
		$image = Default_Registry::$cache->load($cacheKey);
		if (null !== ($image = Default_Registry::$cache->load($cacheKey))) {
			return $image;
		}
		$image = Cms_Model_File_Dao::findFirstImage('cmsarticle', $this->id);
		Default_Registry::$cache->save($image, $cacheKey, 3600);
		return $image;
	}


	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}