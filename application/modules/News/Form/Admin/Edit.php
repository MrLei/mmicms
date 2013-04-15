<?php

class News_Form_Admin_Edit extends Mmi_Form {

	protected $_recordName = 'News_Model_Record';

	public function init() {

		//ustawia zabezpieczenie CSRF
		$this->setSecured();

		$this->addElement('text', 'title', array(
			'label' => 'Tytuł artykułu',
			'required' => true,
			'filters' => array('StringTrim'),
			'validators' => array(
				'NotEmpty',
			)
		));

		$this->addElement('checkbox', 'internal', array(
			'label' => 'Artykuł wewnętrzny',
			'value' => 1
		));

		$this->addElement('text', 'uri', array(
			'label' => 'Link do treści zewnętrznej',
		));
		
		$this->addElement('tinyMce', 'lead', array(
			'label' => 'Podsumowanie (zajawka)',
		));

		$this->addElement('tinyMce', 'text', array(
			'label' => 'Treść',
			'mode' => 'advanced',
			'img' => 'news:' . $this->getRecord()->id,
			'required' => true
		));

		$this->addElement('select', 'visible', array(
			'label' => 'Publikacja',
			'multiOptions' => array(
				1 => 'włączony',
				0 => 'wyłączony',
			),
		));

		$this->addElement('uploader', 'uploader', array(
			'label' => 'Dołącz pliki',
		));

		$this->addElement('submit', 'submit', array(
			'ignore' => true,
			'label' => 'Zapisz',
		));
	}

}