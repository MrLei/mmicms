<?php

class Cron_Form_Cron extends Mmi_Form {

	protected $_recordName = 'Cron_Model_Record';

	public function init() {
		$this->addElement('text', 'name', array(
			'label' => 'Nazwa zadania',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 50)),
			)
		));

		$this->addElement('textarea', 'description', array(
			'label' => 'Opis',
			'required' => true
		));

		$this->addElement('text', 'minute', array(
			'label' => 'Minuta',
			'description' => 'minuta (0 - 59) lub np ( */5 wykonaj co 5 minut), (10,20 w dziesiątej i dwudziestej minucie godziny) , ( * w każdej minucie)',
			'required' => true,
		));

		$this->addElement('text', 'hour', array(
			'label' => 'Godzina',
			'description' => 'godzina (0 - 23)',
			'required' => true,
		));

		$this->addElement('text', 'dayOfMonth', array(
			'label' => 'Dzień miesiąca',
			'description' => 'dzień miesiąca (1 - 31)',
			'required' => true,
		));

		$this->addElement('text', 'month', array(
			'label' => 'Miesiąc',
			'description' => 'miesiąc (1 - 12)',
			'required' => true,
		));

		$this->addElement('text', 'dayOfWeek', array(
			'label' => 'Dzień tygodnia',
			'description' => 'dzień tygodnia (1 - 7) (Poniedziałek=1, Wtorek=2,..., Niedziela=7)',
			'required' => true,
		));

		$value = null;
		if ($this->getRecord()) {
			$value = $this->getRecord()->module . '_' . $this->getRecord()->controller . '_' . $this->getRecord()->action;
		}

		//system object
		$this->addElement('select', 'object', array(
			'label' => 'Obiekt CMS',
			'description' => 'Istniejące obiekty CMS',
			'required' => true,
			'id' => 'objectId',
			'value' => $value
		));

		$reflection = new Admin_Model_Reflection();
		$object = $this->getElement('object');
		$object->setDisableTranslator(true);
		$object->addMultiOption(null, '---');
		foreach ($reflection->getActions() as $action) {
			if ($action['controller'] == 'cron') {
				$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
			}
		}

		$this->addElement('checkbox', 'active', array(
			'label' => 'Aktywny',
			'value' => 1,
			'required' => true
		));


		$this->addElement('submit', 'btn_save', array(
			'label' => 'zapisz zadanie'
		));
	}

}