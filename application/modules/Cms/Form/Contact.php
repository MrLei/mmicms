<?php

class Cms_Form_Contact extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Contact_Record';

	public function init() {

		$this->setSecured();

		if (!$this->getOption('subjectId')) {
			$this->addElement('select', 'cms_contact_option_id', array(
				'multiOptions' => Cms_Model_Contact_Option_Dao::findPairs('id', 'name', array(), array('name')),
				'label' => 'Wybierz temat',
				'validators' => array(
					array('validator' => 'Integer'),
				)
			));
		}

		$auth = Default_Registry::$auth;
		$this->addElement('text', 'email', array(
			'label' => 'Twój adres e-mail',
			'value' => $auth->getEmail(),
			'required' => true,
			'validators' => array(
				array('validator' => 'EmailAddress'),
			)
		));

		$this->addElement('textarea', 'text', array(
			'required' => true,
			'label' => 'Wiadomość',
			'filters' => array('StripTags'),
		));

		if (!($auth->getId() > 0)) {
			//captcha dla niezalogowanych
			$this->addElement('captcha', 'regCaptcha', array('label' => 'Przepisz kod'));
		}

		$this->addElement('submit', 'submit', array(
			'label' => 'Wyślij'
		));
	}

	public function prepareSaveData(array $data = array()) {
		if ($this->getOption('subjectId') > 0) {
			$data['cms_contact_option_id'] = $this->getOption('subjectId');
		}
		return $data;
	}

}
