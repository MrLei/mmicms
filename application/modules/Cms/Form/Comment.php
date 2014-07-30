<?php

class Cms_Form_Comment extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Comment_Record';

	public function init() {
		$this->getRecord()->object = $this->getAttrib('object');
		$this->getRecord()->objectId = $this->getAttrib('objectId');

		$this->addElementText('title')
			->setLabel('tytuł');

		$this->addElementTextarea('text')
			->setRequired()
			->setLabel('komentarz')
			->addValidatorNotEmpty();


		if ($this->getAttrib('withRatings') === true) {
			$this->addElementRatings('stars')
				->setLabel('Oceń artykuł');
		}

		if (!Default_Registry::$auth->hasIdentity()) {
			$this->addElementText('signature')
				->setLabel('podpis');
		}

		$this->addElementSubmit('submit')
			->setLabel('dodaj komentarz');
	}

}
