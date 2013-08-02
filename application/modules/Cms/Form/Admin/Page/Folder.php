<?php

class Cms_Form_Admin_Page_Folder extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElement('text', 'label', array(
			'label' => 'Nazwa folderu',
			'description' => 'Nazwa będzie jednocześnie składową tytułu strony',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 64)),
			)
		));

		//opcjonalny tytuł
		$this->addElement('text', 'title', array(
			'label' => 'Tytuł strony (meta/title)',
			'description' => 'Jeśli nie wypełniony, zostanie użyta nazwa w menu',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 128)),
			)
		));

		//opcjonalny opis
		$this->addElement('textarea', 'description', array(
			'label' => 'Opis strony (meta/description)',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 1024)),
			)
		));

		//opcjonalne keywords
		$this->addElement('text', 'keywords', array(
			'label' => 'Słowa kluczowe (meta/keywords)',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 512)),
			)
		));

		//pozycja w drzewie
		$this->addElement('select', 'parent_id', array(
			'label' => 'Element nadrzędny',
			'value' => Mmi_Controller_Front::getInstance()->getRequest()->parent,
			'multiOptions' => Cms_Model_Navigation_Dao::getMultiOptions()
		));

		//optional url
		$this->addElement('select', 'visible', array(
			'label' => 'Widoczność',
			'multiOptions' => array(
				1 => 'widoczny',
				0 => 'ukryty',
			),
			'description' => 'Jeśli niewidoczny, jego dane nie wejdą do ścieżki tytułu i okruchów'
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
		$data['module'] = null;
		$data['controller'] = null;
		$data['action'] = null;
		$data['object'] = null;
		$data['uri'] = null;
		return $data;
	}

}