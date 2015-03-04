<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Form {

	/**
	 * Nazwa formularza
	 * @var string
	 */
	protected $_formBaseName;

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
	 * Obiekt rekordu
	 * @var \Mmi\Dao\Record
	 */
	protected $_record;

	/**
	 * Identyfikator rekordu
	 * @var mixed
	 */
	protected $_recordId;

	/**
	 * Metoda zapisu w rekordzie
	 * @var string
	 */
	protected $_recordSaveMethod = 'save';

	/**
	 * Czy zapisany
	 * @var boolean
	 */
	protected $_saved = false;

	/**
	 * Zwrot zapisu z modelu
	 * @var mixed
	 */
	protected $_saveResult;

	/**
	 * Czy włączone zabezpieczenie csrf
	 * @var boolean
	 */
	protected $_secured = false;

	/**
	 * Opcje formularza
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Elementy formularza
	 * @var array
	 */
	protected $_elements = array();

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
	 * Namespace powiązany z tym formularzem
	 * @var \Mmi\Session\Space
	 */
	protected $_sessionNamespace = null;

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Record\Ro $record obiekt recordu
	 * @param array $options opcje
	 */
	public function __construct(\Mmi\Dao\Record\Ro $record = null, array $options = array()) {
		$this->_options = $options;
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
				if ($element->getType() == 'Mmi\Form\Element\Checkbox' && !isset($this->_values[$element->name]) && $this->isMine()) {
					$this->_values[$element->name] = 0;
				}
				if ($element->getType() == 'Mmi\Form\Element\Select' && $this->isMine()) {
					if (isset($this->_values[$element->name])) {
						$this->_values[$element->name] = ($this->_values[$element->name] === '') ? null : $this->_values[$element->name];
					} else {
						if ($element->multiple == 'multiple') {
							$this->_values[$element->name] = array();
						} else {
							$this->_values[$element->name] = null;
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
			->setValue(\Mmi\Lib::hashTable(array('hash' => $this->_hash, 'class' => $this->_className, 'options' => $this->_options)));

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
	 * Wywołuje walidację i zapis rekordu powiązanego z formularzem.
	 * @return bool
	 */
	public function save() {
		if (!$this->hasRecord()) {
			return $this->isSaved();
		}
		if (!$this->isProper()) {
			return $this->isSaved();
		}
		$this->_saved = $this->_saveRecord($this->_values);
		$this->_saveResult = $this->_record->getSaveStatus();
		if ($this->_saved === false) {
			return false;
		}
		if (null != $this->_sessionNamespace) {
			$this->_sessionNamespace->unsetAll();
		}
		$this->_recordId = $this->_record->getPk();
		return true;
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

	/**
	 * Dodawanie elementu formularza z gotowego obiektu
	 * @param \Mmi\Form\Element\ElementAbstract $element obiekt elementu formularza
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addElement(\Mmi\Form\Element\ElementAbstract $element) {
		$name = $element->getName();
		$this->_elements[$name] = $element;
		$this->_elements[$name]->setForm($this);
		return $element;
	}

	/**
	 * Pobranie elementów formularza
	 * @return array
	 */
	public function getElements() {
		return $this->_elements;
	}

	/**
	 * Pobranie elementu formularza
	 * @param string $name nazwa elementu
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function getElement($name) {
		return isset($this->_elements[$name]) ? $this->_elements[$name] : null;
	}

	/**
	 * Ustawienie wartości opcji
	 * @param mixed $key identyfikator opcji
	 * @param mixed $value wartość
	 * @return \Mmi\Form
	 */
	public function setOption($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}

	/**
	 * Pobieranie wartości opcji
	 * @param mixed $key identyfikator opcji
	 * @return mixed
	 */
	public function getOption($key) {
		return isset($this->_options[$key]) ? $this->_options[$key] : null;
	}

	/**
	 * Pobiera wszystkie opcje
	 * @return array
	 */
	public function getOptions() {
		return $this->_options;
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
	 * Ustawia akcję formularza
	 * @param string $value akcja
	 */
	public function setAction($value) {
		$this->setOption('action', $value);
	}

	/**
	 * Renderer formularza
	 * Renderuje bezpośrednio, lub z szablonu
	 * @return string
	 */
	public function __toString() {
		return $this->render();
	}

	/**
	 * Zwraca obiekt aktywnego rekordu
	 * @return \Mmi\Dao\Record
	 */
	public function getRecord() {
		return $this->_record;
	}

	/**
	 * Czy do formularza przypisany jest active record, jeśli nie, a podana jest nazwa, stworzy obiekt rekordu
	 * @return boolean
	 */
	public function hasRecord() {
		return (null !== $this->_record);
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
	 * Bramka zapisu danych
	 * @param array $data
	 * @return array
	 */
	public function prepareSaveData(array $data = array()) {
		return $data;
	}

	/**
	 * Bramka odczytu danych
	 * @param array $data
	 * @return array
	 */
	public function prepareLoadData(array $data = array()) {
		return $data;
	}

	/**
	 * Czy w modelu wystąpił zapis
	 * @return boolean
	 */
	public function isSaved() {
		return $this->_saved;
	}

	/**
	 * Zwraca status z zapisu rekordu.
	 * @return mixed
	 */
	public function getSaveResult() {
		return $this->_saveResult;
	}

	/**
	 * Konfigurator pól (ustawia id pola na podstawie id macierzystego formularza)
	 */
	protected function _configureFields() {
		foreach ($this->_elements AS $element) {
			$element->__set('id', $this->_formBaseName . '_' . $element->__get('name'));
			$element->__set('class', trim('field ' . $element->__get('class')));
		}
	}

	/**
	 * Renderer nagłówka formularza
	 * @return string
	 */
	public function start() {
		return '<form id="' . $this->_formBaseName .
			'" action="' . ($this->getOption('action') ? $this->getOption('action') : '#') .
			'" method="' . $this->getOption('method') .
			'" enctype="' . $this->getOption('enctype') .
			'" class="vertical ' . $this->getOption('class') .
			'" accept-charset="' . $this->getOption('accept-charset') .
			'">';
	}

	/**
	 * Renderer stopki formularza
	 * @return string
	 */
	public function end() {
		return '</form>';
	}

	/**
	 * Automatyczny renderer formularza
	 * @return string
	 */
	public function render() {
		$html = $this->start();
		foreach ($this->_elements AS $element) {
			$html .= $element->__toString();
		}
		return $html . $this->end();
	}

	/**
	 * Zapis danych do obiektu rekordu
	 * @param array $data
	 * @return boolean
	 */
	protected function _saveRecord($data) {
		unset($data[$this->_formBaseName . '__ctrl']);
		$this->_record->setFromArray($data);
		if (method_exists(($this->_record), $this->_recordSaveMethod)) {
			return $this->_record->{$this->_recordSaveMethod}();
		}
		throw new\Exception('Save method unsupported: ' . $this->_recordSaveMethod);
	}

}
