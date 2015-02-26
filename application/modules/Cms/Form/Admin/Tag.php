<?php

namespace Cms\Form\Admin;

class Tag extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Tag\Record';

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
