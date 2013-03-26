<?php

class Stat_Form_Admin_Label extends Mmi_Form {

	protected $_recordName = 'Stat_Model_Label_Record';

	public function init() {

		$this->addElement('select', 'object', array(
			'label' => 'klucz',
			'required' => true,
			'multiOptions' => Stat_Model_Date_Dao::findUniqueObjects()
		));

		$this->addElement('text', 'label', array(
			'required' => true,
			'label' => 'nazwa statystyki'
		));

		$this->addElement('textarea', 'description', array(
			'label' => 'opis'
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz'
		));
	}

}