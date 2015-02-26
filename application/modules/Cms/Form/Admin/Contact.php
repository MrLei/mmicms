<?php

namespace Cms\Form\Admin;

class Contact extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Contact\Record';
	protected $_recordSaveMethod = 'reply';

	public function init() {

		if (!$this->getOption('subjectId')) {
			$this->addElementSelect('cmsContactOptionId')
				->setDisabled()
				->setIgnore()
				->setValue($this->getOption('subjectId'))
				->setMultiOptions(\Cms\Model\Contact\Option\Dao::getMultioptions())
				->setLabel('temat zapytania');
		}

		$this->addElementText('email')
			->setDisabled()
			->setLabel('email')
			->setValue(\Core\Registry::$auth->getEmail())
			->addValidatorEmailAddress();

		$this->addElementTextarea('text')
			->setDisabled()
			->setLabel('treść zapytania');

		$this->addElementTextarea('reply')
			->setRequired()
			->setLabel('odpowiedź');

		$this->addElementSubmit('submit')
			->setLabel('odpowiedz');
	}

}
