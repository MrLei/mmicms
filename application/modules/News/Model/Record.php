<?php
class News_Model_Record extends Mmi_Dao_Record {

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
    public $lead;
    
    /**
     *
     * @var string
     */
    public $text;
    
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
    public $uri;
    
    /**
     *
     * @var integer
     */
    public $internal;
    
    /**
     *
     * @var integer
     */
    public $visible;
    
	public function save() {
		$filter = new Mmi_Filter_Url();
		$uri = $filter->filter($this->title);
		//identyfikatory dla linków wewnętrznych
		if ($this->internal == 1) {
			$exists = News_Model_Dao::findFirstByUri($uri);
			if ($exists !== null && $exists->getPk() != $this->getPk()) {
				$uri = $uri . '_' . date('Y-m-d');
			}
			$this->uri = $uri;
		}
		$this->lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$this->dateModify = date('Y-m-d H:i:s');
		return parent::save();
	}

	public function getFirstImage() {
		 return Cms_Model_File_Dao::findFirstImage('news', $this->id);
	}

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

	public function delete() {
		Cms_Model_File_Dao::findByObjectId('news', $this->getPk())->delete();
		return parent::delete();
	}

}