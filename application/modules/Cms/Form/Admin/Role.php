<?php


namespace Cms\Form\Admin;

class Role extends \Mmi\Form {

	protected $_recordName = 'Cms\Model\Role\Record';

	public function init() {

		$this->addElementText('name')
			->addValidatorStringLength(3, 64);

		$this->addElementSubmit('submit')
			->setLabel('utwórz rolę');
	}

}
