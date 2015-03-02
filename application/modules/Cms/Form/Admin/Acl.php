<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
