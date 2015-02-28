<?php

namespace Cms\Form\Admin;

class Acl extends \Mmi\Form {

	public function init() {

		$this->_record->cmsRoleId = \Mmi\Controller\Front::getInstance()->getRequest()->roleId;

		$this->addElementSelect('object')
			->setMultiOptions(array_merge(array('' => ''), \Cms\Model\Reflection::getOptionsWildcard()));

		$this->addElementSelect('access')
			->setMultiOptions(array(
				'allow' => 'dozwolone',
				'deny' => 'zabronione'
		));

		$this->addElementSubmit('submit')
			->setLabel('dodaj regułę');
	}

}
