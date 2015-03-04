<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Form extends Form\Base {

	/**
	 * Nazwa klasy
	 * @var string
	 */
	protected $_className;

	/**
	 * Referencja do requestu
	 * @var \Mmi\Controller\Request
	 */
	protected $_request;

	/**
	 * Hash formularza
	 * @var mixed
	 */
	protected $_hash;

	/**
	 * Czy włączone zabezpieczenie csrf
	 * @var boolean
	 */
	protected $_secured = false;

	/**
	 * Surowe dane przychodzące z requesta
	 * @var array
	 */
	protected $_values = array();

	/**
	 * Rezultat walidacji
	 * @var bool
	 */
	protected $_validationResult = null;

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Record\Ro $record obiekt recordu
	 * @param array $options opcje
	 */
	public function __construct(\Mmi\Dao\Record\Ro $record = null, array $options = array()) {
		$this->setOptions($options);
		$this->_record = $record;
		$this->_className = get_class($this);
		$this->_formBaseName = strtolower(substr($this->_className, strrpos($this->_className, '\\') + 1));
		$this->_request = \Mmi\Controller\Front::getInstance()->getRequest();

		$this->setOption('class', 'form_' . $this->_formBaseName);
		$this->setOption('accept-charset', 'utf-8');
		$this->setOption('method', 'post');
		$this->setOption('enctype', 'multipart/form-data');
		$this->_saved = false;

		//dane z post
		if ($this->isMine()) {
			$data = $this->_request->getPost()->toArray();
		}
		if ($this->hasRecord() && !isset($data)) {
			$data = $this->_record->toArray();
			$this->_values = $this->prepareLoadData($data);
		} elseif (isset($data)) {
			$this->_values = $data;
		}
		$this->init();
		//obsługa checkboxów i selectów
		if (!empty($this->_values)) {
			foreach ($this->getElements() as $element) {
				$elementName = $element->getOption('name');
				if ($element->getType() == 'Mmi\Form\Element\Checkbox' && !isset($this->_values[$elementName]) && $this->isMine()) {
					$this->_values[$elementName] = 0;
				}
				if ($element->getType() == 'Mmi\Form\Element\Select' && $this->isMine()) {
					if (isset($this->_values[$elementName])) {
						$this->_values[$elementName] = ($this->_values[$elementName] === '') ? null : $this->_values[$elementName];
					} else {
						if ($element->getOption('multiple') == 'multiple') {
							$this->_values[$elementName] = array();
						} else {
							$this->_values[$elementName] = null;
						}
					}
				}
			}
		}

		$this->_configureFields();
		if ($this->_secured) {
			$this->_hash = sha1($this->_className . microtime(true));
		} else {
			$this->_hash = sha1($this->_className);
		}

		$this->addElementHidden($this->_formBaseName . '__ctrl')
			->setIgnore()
			->setOption('id', $this->_formBaseName . '__ctrl')
			->setValue(\Mmi\Lib::hashTable(array('hash' => $this->_hash, 'class' => $this->_className, 'options' => $this->getOptions())));

		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new \Mmi\Session\Space('\Mmi\Form');
			$hash = $this->_sessionNamespace->{$this->_formBaseName};
			$this->_sessionNamespace->{$this->_formBaseName} = $this->_hash;
			$this->_hash = $hash;
		}

		//automatyczne wywołanie save()
		$this->save();
		$this->setDefaults($this->_values);
		$this->lateInit();
	}

	/**
	 * Sprawdza poprawność całego formularza
	 * @return boolean
	 */
	public function isProper() {
		if (!$this->isMine()) {
			return false;
		}
		$values = array();
		$validatorData = array();
		$values[$this->_formBaseName . '__ctrl'] = isset($this->_values[$this->_formBaseName . '__ctrl']) ? $this->_values[$this->_formBaseName . '__ctrl'] : null;
		foreach ($this->_values as $key => $value) {
			$element = $this->getElement($key);
			if ($element === null) {
				continue;
			}
			$value = $element->applyFilters($value);
			if (!$element->isIgnored()) {
				$values[$key] = $value;
			}
			$validatorData[$key] = $value;
		}
		$this->_values = $values;
		if (!empty($this->_request->getPost()) && $this->isValid($validatorData) && $this->validator()) {
			return true;
		}
		return false;
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
	public function setDefaults($data) {
		if (!is_array($data)) {
			return;
		}
		foreach ($data as $key => $value) {
			if ($key == $this->_formBaseName . '__ctrl') {
				continue;
			}
			$element = $this->getElement($key);
			if ($element !== null) {
				$element->setValue($value);
			}
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
	 * Zwraca wartość pola formularza
	 * @param string $key nazwa pola
	 * @return mixed
	 */
	public function getValue($key) {
		return isset($this->_values[$key]) ? $this->_values[$key] : null;
	}

	/**
	 * Zwraca wszystkie wartości w formularzu
	 * @return array
	 */
	public function getValues() {
		return $this->_values;
	}

	/**
	 * Zwraca czy dane POST są przeznaczone dla tego formularza
	 * @return boolean
	 */
	public function isMine() {
		if (empty($this->_request->getPost())) {
			return false;
		}
		if (!$this->_request->getPost()->__get($this->_formBaseName . '__ctrl')) {
			return false;
		}
		return true;
	}

	/**
	 * Walidacja formularza
	 * @return boolean
	 */
	public function isValid($data) {
		if (isset($this->_validationResult)) {
			return $this->_validationResult;
		}
		$this->_validationResult = true;
		if (!$this->isMine()) {
			$this->_validationResult = false;
			return false;
		}
		$options = \Mmi\Lib::unhashTable($data[$this->_formBaseName . '__ctrl']);
		if ($options['class'] != $this->_className) {
			return false;
		}
		if ($this->_secured && $options['hash'] != $this->_hash) {
			$this->getElement($this->_formBaseName . '__ctrl')->addError('Formularz został już wysłany');
			$this->_validationResult = false;
			return false;
		}
		unset($data[$this->_formBaseName . '__ctrl']);
		$this->setDefaults($data);
		foreach ($this->getElements() as $element) {
			if (!$element->isValid()) {
				$this->_validationResult = false;
			}
		}
		return $this->_validationResult;
	}

	/**
	 * Konfigurator pól (ustawia id pola na podstawie id macierzystego formularza)
	 */
	protected function _configureFields() {
		foreach ($this->getElements() AS $element) {
			$element->setOption('id', $this->_formBaseName . '_' . $element->getOption('name'));
			$element->setOption('class', trim('field ' . $element->getOption('class')));
		}
	}

}
