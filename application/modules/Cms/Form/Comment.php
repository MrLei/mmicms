<?php


namespace Cms\Form;

class Comment extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Comment\Record';

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
			$this->addElementText('stars')
				->setLabel('Oceń artykuł');
		}

		if (!\Core\Registry::$auth->hasIdentity()) {
			$this->addElementText('signature')
				->setLabel('podpis');
		}

		$this->addElementSubmit('submit')
			->setLabel('dodaj komentarz');
	}

}
