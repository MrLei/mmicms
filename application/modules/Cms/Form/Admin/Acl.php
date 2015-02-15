<?php

class Cms_Form_Admin_Acl extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Acl_Record';

	public function init() {

		$this->getRecord()->cmsRoleId = Mmi_Controller_Front::getInstance()->getRequest()->roleId;

		$this->addElementSelect('object')
			->setMultiOptions(array_merge(array('' => ''), Cms_Model_Reflection::getOptionsWildcard()));

		$this->addElementSelect('access')
			->setMultiOptions(array(
				'allow' => 'dozwolone',
				'deny' => 'zabronione'
		));

		$this->addElementSubmit('submit')
			->setLabel('dodaj regułę');
	}

}
