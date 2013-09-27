<?php

class Cms_Form_Admin_Page_Link extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElement('text', 'label', array(
			'label' => 'Tekst linku (href-text)',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 64)),
			)
		));

		//optional url
		$this->addElement('text', 'uri', array(
			'label' => 'Adres strony',
			'description' => 'w formacie http://...',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(6, 255)),
			),
		));

		//menu label
		$this->addElement('text', 'title', array(
			'label' => 'Tytuł linku',
		));

		//optional url
		$this->addElement('select', 'visible', array(
			'label' => 'Pokazuj w menu',
			'multiOptions' => array(
				1 => 'widoczny',
				0 => 'ukryty',
			),
		));

		$this->addElement('checkbox', 'nofollow', array(
			'label' => 'Atrybut rel="nofollow"'
		));

		$this->addElement('checkbox', 'blank', array(
			'label' => 'W nowym oknie'
		));

		//pozycja w drzewie
		$this->addElement('select', 'parent_id', array(
			'label' => 'Element nadrzędny',
			'value' => Mmi_Controller_Front::getInstance()->getRequest()->parent,
			'multiOptions' => Cms_Model_Navigation_Dao::getMultiOptions()
		));

		$this->addElement('dateTimePicker', 'dateStart', array(
			'label' => 'Data i czas włączenia',
		));

		$this->addElement('dateTimePicker', 'dateEnd', array(
			'label' => 'Data i czas wyłączenia',
		));

		$this->addElement('checkbox', 'active', array(
			'label' => 'Włączony'
		));

		//submit
		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz',
			'ignore' => true,
		));
	}

	public function prepareSaveData(array $data = array()) {
		$data['object'] = null;
		return $data;
	}

}