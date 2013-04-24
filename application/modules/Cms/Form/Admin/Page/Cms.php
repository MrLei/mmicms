<?php

class Cms_Form_Admin_Page_Cms extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElement('text', 'label', array(
			'label' => 'Nazwa w menu',
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
		
		$this->addElement('checkbox', 'independent', array(
			'label' => 'Niezależne meta'
		));

		//system object
		$this->addElement('select', 'object', array(
			'label' => $this->getTranslator()->_('Obiekt CMS'),
			'description' => $this->getTranslator()->_('Istniejące obiekty CMS'),
			'required' => true,
			'id' => 'objectId',
		));
		$reflection = new Admin_Model_Reflection();
		$object = $this->getElement('object');
		$object->setDisableTranslator(true);
		$object->addMultiOption(null, null);
		foreach ($reflection->getActions() as $action) {
			$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
		}
		//optional params
		$this->addElement('text', 'params', array(
			'label' => 'Parametry obiektu',
			'description' => 'Dodatkowe parametry adresu w obiekcie'
		));

		$this->addElement('checkbox', 'absolute', array(
			'label' => 'Link bezwzględny'
		));

		$this->addElement('checkbox', 'https', array(
			'label' => 'Połączenie HTTPS'
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

		//submit
		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz',
			'ignore' => true,
		));
	}

}