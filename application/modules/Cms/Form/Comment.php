<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form;

class Comment extends \Mmi\Form {

	public function init() {
		$this->_record->object = $this->getOption('object');
		$this->_record->objectId = $this->getOption('objectId');

		$this->addElementText('title')
			->setLabel('tytuł');

		$this->addElementTextarea('text')
			->setRequired()
			->setLabel('komentarz')
			->addValidatorNotEmpty();


		if ($this->getOption('withRatings') === true) {
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
