<?php

class Cms_Form_Admin_Container extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Record';

	public function init() {

		$this->addElementText('title')
				->setLabel('tytuł')
				->setRequired()
				->addValidatorNotEmpty();

		$this->addElementSelect('cms_container_template_id')
				->setLabel('szablon strony')
				->setMultiOptions(Cms_Model_Container_Template_Dao::findPairs('id', 'name'))
				->setRequired()
				->addValidatorNotEmpty();

		$this->addElementSubmit('submit')
			->setLabel('zapisz stronę');

	}
}
