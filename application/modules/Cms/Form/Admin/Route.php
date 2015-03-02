<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class Route extends \Mmi\Form {

	public function init() {

		$this->addElementText('pattern')
			->setLabel('Wzorzec')
			->setRequired()
			->addValidatorNotEmpty();

		$this->addElementText('replace')
			->setLabel('Tabela zastąpień')
			->setRequired()
			->setDescription('zmienna1=foo&zmienna2=bar')
			->addValidatorNotEmpty();

		$this->addElementText('default')
			->setLabel('Tabela wartości domyślnych')
			->setDescription('zmienna1=foo&zmienna2=bar');

		$this->addElementText('order')
			->setLabel('Indeks kolejności')
			->setRequired()
			->addValidatorInteger();

		$this->addElementSelect('active')
			->setLabel('Aktywna')
			->setMultiOptions(array(0 => 'nie', '1' => 'tak'))
			->addValidatorInteger();

		$this->addElementSubmit('submit')
			->setLabel('Zapisz trasę');
	}

}
