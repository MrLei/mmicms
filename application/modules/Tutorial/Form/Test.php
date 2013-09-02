<?php

class Tutorial_Form_Test extends Mmi_Form {
	protected $_recordName = 'Tutorial_Model_SimpleForm_Record';
//	protected $_recordSaveMethod = 'saveWithPerson';
	
	public function init() {
	
		$this->addElement('text', 'data', array(
			'label' => 'Wpisz jakieś dane:',
			'filters' => array('StringTrim'),
			'description' => '',
			'value' => '',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 128), 'message' => 'Wprowadź poprawne dane.'),
			),
		));
		
		$this->addElement('submit', 'add', array(
			'label' => 'dodaj'
		));
	}	
}
?>
