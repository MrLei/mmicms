<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Widget;

class Text extends \MmiCms\Form {

	public function init() {

		$this->addElementTextarea('data')
			->setLabel('Tekst');

		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

}
