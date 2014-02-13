<?php

class Mail_Form_Admin_Definition extends Mmi_Form {

	protected $_recordName = 'Mail_Model_Definition_Record';

	public function init() {
		$this->addElement('text', 'name', array(
			'label' => 'Unikalna nazwa',
			'required' => true,
			'validators' => array(
				array('validator' => 'RecordUnique', 'options' => array('Mail_Model_Definition_Dao', 'name', $this->getRecord()->id)),
				array('validator' => 'StringLength', 'options' => array(6, 25)),
			)
		));

		$this->addElement('select', 'mail_server_id', array(
			'label' => 'Połącznie',
			'required' => true,
			'multiOptions' => Mail_Model_Server_Dao::findPairsActive()
		));

		$this->addElement('text', 'subject', array(
			'label' => 'Tytuł',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 240)),
			)
		));

		$this->addElement('textarea', 'message', array(
			'label' => 'Treść',
			'required' => true
		));

		$this->addElement('checkbox', 'html', array(
			'label' => 'Wiadomość HTML',
			'required' => true
		));



		$this->addElement('text', 'fromName', array(
			'label' => 'Wyświetlana nazwa (Od kogo)',
			'description' => 'np. Pomoc serwisu xyz.pl',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 240)),
			)
		));

		$this->addElement('text', 'replyTo', array(
			'label' => 'Odpowiedz na',
			'description' => 'Jeśli inny niż z którego wysłano wiadomość',
			'required' => false,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 240)),
			)
		));

		$this->addElement('checkbox', 'active', array(
			'value' => 1,
			'label' => 'aktywny',
			'required' => true
		));

		//submit
		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz mail',
			'ignore' => true,
		));
	}

}