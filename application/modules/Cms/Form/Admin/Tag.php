<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class Tag extends \Mmi\Form {

	public function init() {

		$this->addElementText('tag')
			->setLabel('tag')
			->setRequired()
			->addFilter('StringTrim')
			->addValidatorStringLength(2, 64);

		$this->addElementSubmit('submit')
			->setLabel('zapisz')
			->setIgnore();
	}

}
