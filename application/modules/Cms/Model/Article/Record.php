<?php

class Cms_Model_Article_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $lang;

	/**
	 *
	 * @var string
	 */
	public $title;

	/**
	 *
	 * @var string
	 */
	public $uri;

	/**
	 *
	 * @var string
	 */
	public $dateAdd;

	/**
	 *
	 * @var string
	 */
	public $dateModify;

	/**
	 *
	 * @var string
	 */
	public $text;

	/**
	 *
	 * @var integer
	 */
	public $noindex;

	public function save() {
		$this->dateModify = date('Y-m-d H:i:s');
		$filter = new Mmi_Filter_Url();
		$this->uri = $filter->filter(strip_tags($this->title));
		$result = parent::save();
		Default_Registry::$cache->remove('Cms_Article_' . $this->uri);
		Default_Registry::$cache->remove('Cms_Article_Image' . $this->id);
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
		$cacheKey = 'Cms_Article_Image_' . $this->id;
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
