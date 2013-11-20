<?php

class Cms_Form_Admin_Page_Article extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {

		//menu label
		$this->addElement('text', 'label', array(
			'label' => 'Nazwa w menu',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 64)),
			)
		));

		//opcjonalny opis
		$this->addElement('textarea', 'description', array(
			'label' => 'Opis strony (meta/description)',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 1024)),
			)
		));

		//opcjonalne keywords
		$this->addElement('text', 'keywords', array(
			'label' => 'Słowa kluczowe (meta/keywords)',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 64)),
			)
		));
		$options = array(null => '---') + Cms_Model_Article_Dao::findPairs('id', 'title', Cms_Model_Article_Dao::newQuery()->orderAsc('title'));

		$this->addElement('select', 'article_id', array(
			'label' => 'Artykuł',
			'multiOptions' => $options
			)
		);

		$this->addElement('checkbox', 'absolute', array(
			'label' => 'Link bezwzględny'
		));

		$this->addElement('select', 'https', array(
			'label' => 'Połączenie HTTPS',
			'multiOptions' => array(
				null => 'bez zmian',
				'0' => 'wymuś http',
				'1' => 'wymuś https',
			)
		));

		//optional url
		$this->addElement('select', 'visible', array(
			'label' => 'Pokazuj w menu',
			'multiOptions' => array(
				1 => 'widoczny',
				0 => 'ukryty',
			),
		));

		$this->addElement('checkbox', 'nofollow', array(
			'label' => 'Atrybut rel="nofollow"'
		));

		$this->addElement('checkbox', 'blank', array(
			'label' => 'W nowym oknie'
		));

		//pozycja w drzewie
		$this->addElement('select', 'parent_id', array(
			'label' => 'Element nadrzędny',
			'value' => Mmi_Controller_Front::getInstance()->getRequest()->parent,
			'multiOptions' => Cms_Model_Navigation_Dao::getMultiOptions()
		));

		$this->addElement('dateTimePicker', 'dateStart', array(
			'label' => 'Data i czas włączenia',
		));

		$this->addElement('dateTimePicker', 'dateEnd', array(
			'label' => 'Data i czas wyłączenia',
		));

		$this->addElement('checkbox', 'active', array(
			'label' => 'Włączony'
		));

		//submit
		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz',
			'ignore' => true,
		));
	}

}