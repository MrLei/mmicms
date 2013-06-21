<?php

class Cms_Form_Admin_Acl extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Acl_Record';

	public function init() {

		$this->_record->cms_role_id = Mmi_Controller_Front::getInstance()->getRequest()->roleId;
		$reflection = new Admin_Model_Reflection();

		$this->addElement('select', 'object', array(
			'multiOptions' => array_merge(array('' => ''), $reflection->getOptionsWildcard())
		));

		$this->addElement('select', 'access', array(
			'multiOptions' => array(
				'allow' => 'dozwolone',
				'deny' => 'zabronione'
			)
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'dodaj regułę'
		));

	}

}
