<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form;

class Contact extends \Cms\Form {

	public function init() {

		$this->setSecured();

		if (!$this->getOption('subjectId')) {
			$this->addElementSelect('cmsContactOptionId')
				->setLabel('Wybierz temat')
				->setMultiOptions(\Cms\Model\Contact\Option\Dao::getMultioptions())
				->addValidatorInteger();
		}

		$auth = \Core\Registry::$auth;
		$this->addElementText('email')
			->setLabel('Twój adres email')
			->setValue($auth->getEmail())
			->setRequired()
			->addValidatorEmailAddress();

		$this->addElementTextarea('text')
			->setLabel('Wiadomość')
			->setRequired()
			->addFilter('StripTags');

		if (!($auth->getId() > 0)) {
			//captcha dla niezalogowanych
			$this->addElementCaptcha('regCaptcha')
				->setLabel('Przepisz kod');
		}

		$this->addElementSubmit('submit')
			->setLabel('Wyślij');
	}

	public function prepareSaveData(array $data = array()) {
		if ($this->getOption('subjectId') > 0) {
			$data['cmsContactOptionId'] = $this->getOption('subjectId');
		}
		return $data;
	}

}
