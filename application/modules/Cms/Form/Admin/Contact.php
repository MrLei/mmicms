<?php

class Cms_Form_Admin_Contact extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Contact_Record';
	protected $_recordSaveMethod = 'reply';

	public function init() {

		if (!$this->getOption('subjectId')) {
			$this->addElement('select', 'cms_contact_option_id', array(
				'disabled' => true,
				'multiOptions' => Cms_Model_Contact_Option_Dao::findPairs('id', 'name', array(), array('name')),
				'label' => 'temat zapytania'
			));
		}

		$this->addElement('text', 'email', array(
			'label' => 'e-mail',
			'disabled' => true,
			'value' => Mmi_Auth::getInstance()->getEmail(),
			'validators' => array(
				array('validator' => 'EmailAddress'),
			)
		));

		$this->addElement('textarea', 'text', array(
			'disabled' => true,
			'label' => 'treść zapytania'
		));

		$this->addElement('textarea', 'reply', array(
			'required' => true,
			'label' => 'odpowiedź'
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'odpowiedz'
		));
	}

}
