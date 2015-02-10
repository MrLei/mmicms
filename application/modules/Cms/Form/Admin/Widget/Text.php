<?php

class Cms_Form_Admin_Widget_Text extends MmiCms_Form {

	protected $_recordName = 'Cms_Model_Widget_Text_Record';
	
	public function init() {

		$this->addElementTextarea('data')
			->setLabel('Tekst');
		
		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
		
	}

}
