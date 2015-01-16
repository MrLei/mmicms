<?php

class Cron_Form_Cron extends Mmi_Form {

	protected $_recordName = 'Cron_Model_Record';

	public function init() {
		$this->addElementText('name')
			->setLabel('Nazwa zadania')
			->setRequired()
			->addValidatorStringLength(2, 50);

		$this->addElementTextarea('description')
			->setLabel('Opis')
			->setRequired();

		$this->addElementText('minute')
			->setLabel('Minuta')
			->setDescription('minuta (0 - 59) lub np ( */5 wykonaj co 5 minut), (10,20 w dziesiątej i dwudziestej minucie godziny) , ( * w każdej minucie)')
			->setRequired();

		$this->addElementText('hour')
			->setLabel('Godzina')
			->setDescription('godzina (0 - 23)')
			->setRequired();

		$this->addElementText('dayOfMonth')
			->setLabel('Dzień miesiąca')
			->setDescription('dzień miesiąca (1 - 31)')
			->setRequired();

		$this->addElementText('month')
			->setLabel('Miesiąc')
			->setDescription('miesiąc (1 - 12)')
			->setRequired();

		$this->addElementText('dayOfWeek')
			->setLabel('Dzień tygodnia')
			->setDescription('dzień tygodnia (1 - 7) (Poniedziałek=1, Wtorek=2,..., Niedziela=7)')
			->setRequired();

		$value = null;
		if ($this->getRecord()) {
			$value = $this->getRecord()->module . '_' . $this->getRecord()->controller . '_' . $this->getRecord()->action;
		}

		//system object
		$this->addElementSelect('object')
			->setLabel('Obiekt CMS')
			->setDescription('Istniejące obiekty CMS')
			->setRequired()
			->addValidatorNotEmpty()
			->setOption('id', 'objectId')
			->setValue($value);

		$reflection = new Admin_Model_Reflection();
		$object = $this->getElement('object');
		$object->setDisableTranslator(true);
		$object->addMultiOption(null, '---');
		foreach ($reflection->getActions() as $action) {
			if ($action['controller'] == 'cron') {
				$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
			}
		}

		$this->addElementCheckbox('active')
			->setLabel('Aktywny')
			->setValue(1)
			->setRequired();

		$this->addElementSubmit('btn_save')->setLabel('zapisz zadanie');
	}

}
