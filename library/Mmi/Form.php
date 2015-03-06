<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Form extends Form\Base\Form {

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Record $record obiekt recordu
	 * @param array $options opcje
	 */
	public function __construct(\Mmi\Dao\Record $record = null, array $options = array()) {
		$this->setOptions($options);
		$this->_record = $record;
		$this->_className = get_class($this);
		$this->_formBaseName = strtolower(substr($this->_className, strrpos($this->_className, '\\') + 1));
		$this->_request = \Mmi\Controller\Front::getInstance()->getRequest();
		$this->_saved = false;

		//domyślne opcje
		$this->setOption('class', 'form_' . $this->_formBaseName)
			->setOption('accept-charset', 'utf-8')
			->setOption('method', 'post')
			->setOption('enctype', 'multipart/form-data');

		//dane z rekordu
		if ($this->hasNotEmptyRecord()) {
			$data = $this->_record->toArray();
		}
		
		//dane z POST
		if ($this->isMine()) {
			$data = $this->_request->getPost()->toArray();
		}
		
		//inicjalizacja formularza
		$this->init();
		
		//dodawanie CTRL
		$this->addElementHidden($this->_formBaseName . '__ctrl')
			->setIgnore()
			->setOption('id', $this->_formBaseName . '__ctrl');
		
		//jeśli zabezpieczony formularz, odczytujemy hash z sesji
		$this->_hash = md5($this->_className);
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_hash = $this->_sessionNamespace->{$this->_formBaseName};
		}

		//konfiguracja elementów
		$this->_configureElements();

		//jeśli przyszły dane - ustawienie w pola
		if (isset($data)) {
			//ustawienie wartości domyślnych
			$this->setDefaults($this->prepareLoadData($data));
		}
		
		//zapis do rekordu jeśli istnieje
		$this->save();
		$this->lateInit();

		//nowy hash
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_sessionNamespace->{$this->_formBaseName} = ($this->_hash = md5($this->_className . microtime(true)));
		}
		
		//tworzenie pola ctrl
		$this->getElement($this->_formBaseName . '__ctrl')
			->setValue(\Mmi\Lib::hashTable(array('hash' => $this->_hash, 'class' => $this->_className, 'options' => $this->getOptions())));
	}
	
	/**
	 * Button
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Button
	 */
	public function addElementButton($name) {
		return $this->addElement(new \Mmi\Form\Element\Button($name));
	}

	/**
	 * Checkbox
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Checkbox
	 */
	public function addElementCheckbox($name) {
		return $this->addElement(new \Mmi\Form\Element\Checkbox($name));
	}

	/**
	 * File
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\File
	 */
	public function addElementFile($name) {
		return $this->addElement(new \Mmi\Form\Element\File($name));
	}

	/**
	 * Hidden
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Hidden
	 */
	public function addElementHidden($name) {
		return $this->addElement(new \Mmi\Form\Element\Hidden($name));
	}

	/**
	 * Label
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Label
	 */
	public function addElementLabel($name) {
		return $this->addElement(new \Mmi\Form\Element\Label($name));
	}

	/**
	 * Multi-checkbox
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\MultiCheckbox
	 */
	public function addElementMultiCheckbox($name) {
		return $this->addElement(new \Mmi\Form\Element\MultiCheckbox($name));
	}

	/**
	 * Password
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Password
	 */
	public function addElementPassword($name) {
		return $this->addElement(new \Mmi\Form\Element\Password($name));
	}

	/**
	 * Radio
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Radio
	 */
	public function addElementRadio($name) {
		return $this->addElement(new \Mmi\Form\Element\Radio($name));
	}

	/**
	 * Select
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Select
	 */
	public function addElementSelect($name) {
		return $this->addElement(new \Mmi\Form\Element\Select($name));
	}

	/**
	 * Submit
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Submit
	 */
	public function addElementSubmit($name) {
		return $this->addElement(new \Mmi\Form\Element\Submit($name));
	}

	/**
	 * Text
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Text
	 */
	public function addElementText($name) {
		return $this->addElement(new \Mmi\Form\Element\Text($name));
	}

	/**
	 * Textarea
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Textarea
	 */
	public function addElementTextarea($name) {
		return $this->addElement(new \Mmi\Form\Element\Textarea($name));
	}


}
