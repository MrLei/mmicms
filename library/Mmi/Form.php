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

		$this->setOption('class', 'form_' . $this->_formBaseName)
			->setOption('accept-charset', 'utf-8')
			->setOption('method', 'post')
			->setOption('enctype', 'multipart/form-data');

		$data = array();
		//dane z rekordu
		if ($this->hasRecord()) {
			$data = $this->_record->toArray();
		}
		//dane z POST
		if ($this->isMine()) {
			$data = $this->_request->getPost()->toArray();
		}
		$this->init();

		//jeśli zabezpieczony formularz, odczytujemy hash z sesji
		$this->_hash = md5($this->_className);
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_hash = $this->_sessionNamespace->{$this->_formBaseName};
		}

		$this->_configureFields();

		//automatyczne wywołanie save()
		$this->setDefaults($this->prepareLoadData($data));
		
		//zapis do rekordu jeśli istnieje
		$this->save();
		$this->lateInit();

		//nowy hash
		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$this->_sessionNamespace->{$this->_formBaseName} = ($this->_hash = md5($this->_className . microtime(true)));
		}
		$this->addElementHidden($this->_formBaseName . '__ctrl')
			->setIgnore()
			->setOption('id', $this->_formBaseName . '__ctrl')
			->setValue(\Mmi\Lib::hashTable(array('hash' => $this->_hash, 'class' => $this->_className, 'options' => $this->getOptions())));
	}

	/**
	 * Inicjalizacja formularza
	 */
	abstract public function init();

	/**
	 * Metoda użytkownika wykonywana na koniec konstruktora
	 */
	public function lateInit() {
		
	}

	/**
	 * Metoda walidacji całego formularza
	 * @return boolean
	 */
	public function validator() {
		return true;
	}

	/**
	 * Ustawienie wartości pól
	 * @param mixed $data
	 */
	public function setDefaults(array $data = array()) {
		foreach ($data as $key => $value) {
			if ($key === $this->_formBaseName . '__ctrl') {
				$this->_ctrl = $value;
				continue;
			}
			if (null === ($element = $this->getElement($key))) {
				continue;
			}
			$element->setValue($value);
		}
	}

	/**
	 * Ustawia zabezpieczenie CSRF
	 * @param boolean $secured
	 */
	public function setSecured($secured = true) {
		$this->_secured = $secured;
	}

	/**
	 * Konfigurator pól (ustawia id pola na podstawie id macierzystego formularza)
	 */
	protected function _configureFields() {
		foreach ($this->getElements() AS $element) {
			if ($element instanceof \Mmi\Form\Element\Checkbox) {
				$element->setValue(0);
			} elseif ($element instanceof \Mmi\Form\Element\Select && $element->getOption('multiple')) {
				$element->setValue(array());
			}
			$element->setOption('id', $this->_formBaseName . '_' . $element->getOption('name'));
			$element->setOption('class', trim('field ' . $element->getOption('class')));
		}
	}

}
