<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
