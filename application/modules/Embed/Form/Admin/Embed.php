<?php

class Embed_Form_Admin_Embed extends Mmi_Form {

	protected $_recordName = 'Embed_Model_Record';

	public function init() {

		//wybór domeny
		$this->addElement('select', 'embed_domain_id', array(
			'label' => 'Domena',
			'required' => true,
			'validators' => array(
				'NotEmpty'
			),
			'multiOptions' => Embed_Model_Domain_Dao::findPairs('id', 'name')
		));

		//system object
		$this->addElement('select', 'object', array(
			'label' => 'Obiekt CMS',
			'description' => 'Istniejące obiekty CMS',
			'required' => true,
			'value' => trim($this->getRecord()->module . '_' . $this->getRecord()->controller . '_' . $this->getRecord()->action, '_'),
			'validators' => array(
				'NotEmpty'
			),
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

		$this->addElement('text', 'width', array(
			'required' => true,
			'label' => 'szerokość',
			'validators' => array(
				'Integer'
			),
		));

		$this->addElement('text', 'height', array(
			'required' => true,
			'label' => 'wysokość',
			'validators' => array(
				'Integer'
			),
		));

		$this->addElement('checkbox', 'iframe', array(
			'label' => 'Wyświetlaj w iframe'
		));

		$this->addElement('checkbox', 'active', array(
			'label' => 'Aktywny',
			'value' => 1
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz konfigurację'
		));
	}

}