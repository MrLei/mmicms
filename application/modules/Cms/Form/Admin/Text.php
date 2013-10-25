<?php

class Cms_Form_Admin_Text extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Text_Record';

	public function init() {

		$this->addElement('text', 'key', array(
			'label' => 'klucz'
		));

		$this->addElement('textarea', 'content', array(
			'label' => 'zawartość'
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz tekst'
		));
	}

}
