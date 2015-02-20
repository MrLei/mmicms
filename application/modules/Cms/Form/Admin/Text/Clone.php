<?php


namespace Cms\Form\Admin\Text;

class Copy extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Text\Record';
	protected $_recordSaveMethod = 'cloneKeys';

	public function init() {

		$langMultiOptions = array();
		foreach (\Core\Registry::$config->application->languages as $lang) {
			if ($lang == \Mmi\Controller\Front::getInstance()->getRequest()->lang) {
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
