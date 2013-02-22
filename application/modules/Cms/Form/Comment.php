<?php

class Cms_Form_Comment extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Comment_Record';

	public function init() {
		$name = explode('_', substr($this->getAttrib('name'), 0, -4));
		if (isset($name[1])) {
			$name = explode('-', $name[1]);
			if (isset($name[0]) && isset($name[1])) {
				$this->getRecord()->object = $name[0];
				$this->getRecord()->objectId = $name[1];
			}
		}

		$this->addElement('text', 'title', array(
			'label' => 'tytuł'
		));

		
		$this->addElement('textarea', 'text', array(
				'required' => true,
				'label' => 'komentarz',
				'validators' => array(
						'NotEmpty'
				)
		));
		
		if($this->getAttrib('withRatings') === true) {
			$this->addElement('ratings', 'stars', array(
				'label' => 'Oceń artykuł'
				));
		}
		
		if (!Mmi_Auth::getInstance()->hasIdentity()) {
			$this->addElement('text', 'signature' , array(
					'label' => 'podpis'
			));
		}
		
		$this->addElement('submit', 'submit' , array(
				'label' => ($this->getAttrib('submitLabel') !== null) ? $this->getAttrib('submitLabel') : 'dodaj komentarz'
		));

	}

}
