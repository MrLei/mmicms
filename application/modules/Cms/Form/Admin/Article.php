<?php

class Cms_Form_Admin_Article extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Article_Record';

	public function init() {

		$this->addElement('text', 'title', array(
			'label' => 'tytuł'
		));

		$this->addElement('tinyMce', 'text', array(
			'label' => 'treść artykułu',
			'mode' => 'advanced'
		));

		//uploader
		$this->addElement('uploader', 'uploader', array(
			'label' => 'Załaduj pliki'
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz stronę'
		));
	}

}
