<?php

class Cms_Form_Admin_Text_Clone extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Text_Record';
	protected $_recordSaveMethod = 'cloneKeys';

	public function init() {
		
		$langMultiOptions = array();
		foreach (Default_Registry::$config->application->languages as $lang) {
			if ($lang == Mmi_Controller_Front::getInstance()->getRequest()->lang) {
				continue;
			}
			$langMultiOptions[$lang] = $lang;
		}

		$this->addElementSelect('source')
			->setLabel('Wybierz język źródłowy')
			->setDescription('Brakujące klucze w bieżącym języku zostaną utworzone, wartości zostaną uzupełnione wartościami z języka źródłowego')
			->setMultiOptions($langMultiOptions);

		$this->addElementSubmit('submit')
			->setLabel('klonuj teksty');

	}
}
