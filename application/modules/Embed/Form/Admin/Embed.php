<?php

class Embed_Form_Admin_Embed extends Mmi_Form {

	protected $_recordName = 'Embed_Model_Record';

	public function init() {

		//wybór domeny
		$this->addElementSelect('embed_domain_id')
			->setLabel('Domena')
			->setRequired()
			->addValidatorNotEmpty()
			->setMultiOptions(Embed_Model_Domain_Dao::findPairs('id', 'name'));

		//system object
		$object = $this->addElementSelect('object')
			->setLabel('Obiekt CMS')
			->setDescription('Istniejące obiekty CMS')
			->setRequired()
			->setValue(trim($this->getRecord()->module . '_' . $this->getRecord()->controller . '_' . $this->getRecord()->action, '_'))
			->addValidatorNotEmpty()
			->setDisableTranslator()
			->addMultiOption(null, null);

		$reflection = new Admin_Model_Reflection();
		foreach ($reflection->getActions() as $action) {
			$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
		}

		//optional params
		$this->addElementText('params')
			->setLabel('Parametry obiektu')
			->setDescription('Dodatkowe parametry adresu w obiekcie');

		$this->addElementText('width')
			->setRequired()
			->setLabel('szerokość')
			->addValidatorInteger();

		$this->addElementText('height')
			->setRequired()
			->setLabel('wysokość')
			->addValidatorInteger();

		$this->addElementCheckbox('iframe')
			->setLabel('Wyświetlaj w iframe');

		$this->addElementCheckbox('active')
			->setLabel('Aktywny')
			->setValue(1);

		$this->addElementSubmit('submit')
			->setLabel('Zapisz konfigurację');
	}

}
