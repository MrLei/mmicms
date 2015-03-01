<?php

namespace Cms\Form\Admin;

class Text extends \Mmi\Form {

	public function init() {

		$this->addElementText('key')
			->setLabel('klucz');

		$this->addElementTextarea('content')
			->setLabel('zawartość');

		$this->addElementSubmit('submit')
			->setLabel('zapisz tekst');
	}

}
