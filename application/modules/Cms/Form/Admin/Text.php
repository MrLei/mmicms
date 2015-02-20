<?php


namespace Cms\Form\Admin;

class Text extends \Mmi\Form {

	protected $_recordName = 'Cms\Model\Text\Record';

	public function init() {

		$this->addElementText('key')
			->setLabel('klucz');

		$this->addElementTextarea('content')
			->setLabel('zawartość');

		$this->addElementSubmit('submit')
			->setLabel('zapisz tekst');
	}

}
