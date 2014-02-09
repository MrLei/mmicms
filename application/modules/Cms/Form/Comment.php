<?php

class Cms_Form_Comment extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Comment_Record';

	public function init() {
		$this->getRecord()->object = $this->getAttrib('object');
		$this->getRecord()->objectId = $this->getAttrib('objectId');

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

		if ($this->getAttrib('withRatings') === true) {
			$this->addElement('ratings', 'stars', array(
				'label' => 'Oceń artykuł'
			));
		}

		if (!Default_Registry::$auth->hasIdentity()) {
			$this->addElement('text', 'signature', array(
				'label' => 'podpis'
			));
		}

		$this->addElement('submit', 'submit', array(
			'label' => 'dodaj komentarz'
		));
	}

}
