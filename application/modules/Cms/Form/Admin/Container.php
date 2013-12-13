<?php

class Cms_Form_Admin_Container extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Record';

	public function init() {

		$this->addElement('text', 'title', array(
			'label' => 'tytuł',
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('select', 'cms_container_template_id', array(
			'label' => 'szablon strony',
			'multiOptions' => Cms_Model_Container_Template_Dao::findPairs('id', 'name'),
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz stronę'
		));
	}

}
