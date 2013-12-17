<?php

class Cms_Form_Admin_Route extends Mmi_Form {
	
	protected $_recordName = 'Cms_Model_Route_Record';
	
	public function init() {
		
		$this->addElement('text', 'pattern', array(
			'label' => 'Wzorzec',
			'required' => true,
			'validators' => array('NotEmpty')
		));
		
		$this->addElement('text', 'replace', array(
			'label' => 'Tabela zastąpień',
			'required' => true,
			'description' => 'zmienna1=foo&zmienna2=bar',
			'validators' => array('NotEmpty')
		));

		$this->addElement('text', 'default', array(
			'label' => 'Tabela wartości domyślnych',
			'description' => 'zmienna1=foo&zmienna2=bar',
		));
		
		$this->addElement('text', 'order', array(
			'label' => 'Indeks kolejności',
			'required' => true,
			'validators' => array('Integer')
		));
		
		$this->addElement('select', 'active', array(
			'label' => 'Aktywna',
			'multiOptions' => array(0 => 'nie', '1' => 'tak'),
			'validators' => array('Integer')
		));
		
		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz trasę',
		));

	}
	
}