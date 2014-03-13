<?php

class Cms_Form_Admin_Container_Template_Placeholder_Container extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Placeholder_Container_Record';

	public function init() {

		if (!$this->getRecord()->cms_container_id) {
			$this->getRecord()->cms_container_id = $this->getOption('containerId');
		}
		$container = Cms_Model_Container_Dao::findPk($this->getRecord()->cms_container_id);

		$this->addElementSelect('cms_container_template_placeholder_id')
			->setLabel('nazwa placeholdera')
			->setRequired()
			->setMultiOptions(Cms_Model_Container_Template_Placeholder_Dao::findPairsByTemplateId('id', 'name', $container->cms_container_template_id))
			->addValidatorNotEmpty();

		$value = null;
		if ($this->getRecord()) {
			$value = $this->getRecord()->module . '_' . $this->getRecord()->controller . '_' . $this->getRecord()->action;
		}

		$this->addElementSelect('object')
			->setLabel('obiekt CMS')
			->setValue($value);

		$reflection = new Admin_Model_Reflection();
		$object = $this->getElement('object');
		$object->addMultiOption(null, '---');
		foreach ($reflection->getActions() as $action) {
			if ($action['module'] != 'admin' && substr($action['controller'], 0, 5) != 'admin') {
				$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
			}
		}

		$this->addElementText('params')
			->setLabel('parametry');

		$this->addElementText('marginTop')
			->setLabel('margines górny')
			->addValidatorInteger();

		$this->addElementText('marginRight')
			->setLabel('margines prawy')
			->addValidatorInteger();

		$this->addElementText('marginBottom')
			->setLabel('margines dolny')
			->addValidatorInteger();

		$this->addElementText('marginLeft')
			->setLabel('margines left')
			->addValidatorInteger();

		$this->addElementSubmit('submit')
			->setLabel('zapisz placeholder');
	}

}
