<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Form.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa formularza
 * @category   Mmi
 * @package    \Mmi\Form
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
	 * Nazwa obiektu do przypięcia plików
	 * @var string
	 */
	protected $_fileObjectName;

	/**
	 * Nazwa rekordu
	 * @var string
	 */
	protected $_recordName;

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
	 * Automatyczne wywołanie save w konstruktorze.
	 * @var bool
	 */
	protected $_autoSave = true;

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
	 * Dane do ustawienia w zapisywanym rekordzie.
	 * Array, którego kluczami powinny być nazwy pól rekordu (kolumn w bazie).
	 * Tutaj np. przekazujemy wartości dla kolumn, które są kluczami obcymi.
	 * @var array
	 */
	protected $_recordValues = array();

	/**
	 * Podformularze
	 * @var array
	 */
	protected $_subForms = array();

	/**
	 * Czy udało się zapisać podformularze
	 * @var bool
	 */
	protected $_subFormsSaved = false;

	/**
	 * Czy jestem podformularzem
	 * @var bool
	 */
	protected $_isSubForm = false;

	/**
	 * Prefiks dla nazw pól formularza. Używany dla podformularzy.
	 * @var string
	 */
	protected $_subFormPrefix = '';

	/**
	 * Nazwa kolumny do zapisu powiązania z formularzem rodzicem.
	 * Jeśli podana, zapis podformularza ustawi wartość dla tej kolumny
	 * na id głównego formularza.
	 * @var null|string
	 */
	protected $_parentFormColumnName;

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
	 * @param mixed $id identyfikator modelu lub obiekt recordu
	 * @param array $options opcje
	 * @param string $className nazwa klasy
	 */
	public function __construct($id = null, array $options = array(), $className = null) {
		$this->_options = $options;

		//@TODO: bardzo brzydki hak, przerobimy to - jeśli przekazano obiekt rekordu zamiast id
		if (is_object($id) && ($id instanceof \Mmi\Dao\Record)) {
			$this->_record = $id;
			$this->_recordId = $id->getPk();
			$this->_recordName = get_class($id);
			$id = $this->_recordId;
		} elseif (null === $id || is_numeric($id)) {
			$this->_recordId = $id;
		} else {
			throw new\Exception('Invalid record object');
		}

		$this->_className = isset($className) ? $className : get_class($this);

		//kalkulacja nazwy plików dla active record
		if ($this->_recordName) {
			$this->_fileObjectName = $this->_classToFileObject($this->_recordName);
		}

		$this->_request = \Mmi\Controller\Front::getInstance()->getRequest();

		if (!$this->getAttrib('name')) {
			$this->_formBaseName = strtolower(substr($this->_className, strrpos($this->_className, '\\') + 1));
		} else {
			$this->_formBaseName = $this->getAttrib('name');
		}

		//nadpisana obsługa autoSave
		if ($this->getOption('autoSave') !== null) {
			$this->_autoSave = (bool) $this->getOption('autoSave');
		}
		//czy jest to subform
		if ($this->getOption('subForm') !== null) {
			$this->_isSubForm = (bool) $this->getOption('subForm');
		}
		//prefiks dla pól formularza, jeśli to podformularz
		if ($this->_isSubForm && empty($this->_subFormPrefix)) {
			$this->_subFormPrefix = $this->_formBaseName . '_';
		}

		$view = \Mmi\Controller\Front::getInstance()->getView();

		if ($this->_isSubForm) {
			//dla podformularzy nie wolno edytować ustawionej nazwy, bo jest ona
			//używana do automatycznego generowania prefiksów pól
			$this->setAttrib('name', $this->_formBaseName);
		} else {
			//brzydka zmiana nazwy, ale zostawiam, aby było kompatybilne wstecz
			$this->setAttrib('name', 'form_' . $this->_formBaseName);
		}
		$this->setAttrib('class', 'form_' . $this->_formBaseName);
		$this->setAttrib('accept-charset', 'utf-8');
		$this->setAttrib('method', 'post');
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->_saved = false;

		//dane z post
		if ($this->isMine()) {
			$data = $this->_request->getPost();
		}
		if ($this->hasRecord() && $id !== null && !isset($data)) {
			$data = $this->_record->toArray();
			$this->_values = $this->_mapLoadData($this->prepareLoadData($data));
		} elseif (isset($data)) {
			$this->_values = $data;
		}
		$this->init();
		//obsługa checkboxów i selectów
		if (!empty($this->_values)) {
			foreach ($this->getElements() as $element) {
				if ($element->getType() == '\Mmi\Form\Element\Checkbox' && !isset($this->_values[$element->name]) && $this->isMine()) {
					$this->_values[$element->name] = 0;
				}
				if ($element->getType() == '\Mmi\Form\Element\Select' && $this->isMine()) {
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

		$this->configureFields();
		$formName = $this->_formBaseName . 'Form';
		$view->$formName = $this;
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
		if ($this->_autoSave) {
			$this->save();
		}

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
		if ($this->_request->isPost() && $this->isValid($validatorData) && $this->validator()) {
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
		if ($this->_saved === true) {
			if (null != $this->_sessionNamespace) {
				$this->_sessionNamespace->unsetAll();
			}
			$this->_appendFiles($this->_record->getPk(), $this->getFiles());
			$this->_recordId = $this->_record->getPk();
		}
		return $this->isSaved();
	}

	/**
	 * Zwraca id zapisanego rekordu w bazie.
	 * @return null|int
	 */
	public function getRecordId() {
		return $this->_recordId;
	}

	/**
	 * Inicjalizacja formularza
	 * @see \Mmi\Form::lateInit();
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
		//automatyczne dodawanie prefiksów do pól subformów
		if ($this->_isSubForm) {
			if (strpos($name, $this->_subFormPrefix) === false) {
				$name = $this->_subFormPrefix . $name;
				$element->setName($name);
			}
		}
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
		//automatyczne dodawanie prefiksów do pól subformów
		if ($this->_isSubForm) {
			if (strpos($name, $this->_subFormPrefix) === false) {
				$name = $this->_subFormPrefix . $name;
			}
		}
		return isset($this->_elements[$name]) ? $this->_elements[$name] : null;
	}

	/**
	 * Pobranie wartości z opcji
	 * @param mixed $key identyfikator opcji
	 * @return mixed
	 */
	public function getAttrib($key) {
		return isset($this->_options[$key]) ? $this->_options[$key] : null;
	}

	/**
	 * Ustawienie wartości opcji
	 * @param mixed $key identyfikator opcji
	 * @param mixed $value wartość
	 * @return \Mmi\Form
	 */
	public function setAttrib($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}

	/**
	 * Alias getAttrib()
	 * @param mixed $key identyfikator opcji
	 * @return mixed
	 */
	public function getOption($key) {
		return $this->getAttrib($key);
	}

	/**
	 * Pobiera wszystkie opcje
	 * @return array
	 */
	public function getOptions() {
		return $this->_options;
	}

	/**
	 * Pobranie wartości zdefiniowanej dla pola rekordu do zapisu.
	 * @param string $key identyfikator
	 * @return mixed
	 */
	public function getRecordValue($key) {
		return isset($this->_recordValues[$key]) ? $this->_recordValues[$key] : null;
	}

	/**
	 * Pobranie wartości zdefiniowanych dla pól rekordu do zapisu.
	 * @return array
	 */
	public function getRecordValues() {
		return $this->_recordValues;
	}

	/**
	 * Ustawienie wartości dla pola rekordu do zapisu.
	 * @param string $key identyfikator
	 * @param mixed $value wartość
	 * @return \Mmi\Form
	 */
	public function setRecordValue($key, $value) {
		$this->_recordValues[$key] = $value;
		return $this;
	}

	/**
	 * Ustawienie wartości dla pól rekordu do zapisu.
	 * @param array wartości dla pól rekordu
	 * @return \Mmi\Form
	 */
	public function setRecordValues(array $values = array()) {
		$this->_recordValues = $values;
		return $this;
	}

	/**
	 * Czyszczenie wartości dla pól rekordu do zapisu.
	 * @return \Mmi\Form
	 */
	public function clearRecordValues() {
		$this->_recordValues = array();
		return $this;
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
		$this->setAttrib('action', $value);
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
		if (!$this->_recordName) {
			return false;
		}
		if ($this->_record instanceof \Mmi\Dao\Record) {
			return true;
		}
		if ($this->_record !== null) {
			throw new\Exception('Invalid record supplied');
		}
		$recordName = $this->_recordName;
		$this->_record = new $recordName($this->_recordId);
		return true;
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
		if (!$this->_request->isPost()) {
			return false;
		}
		$data = $this->_request->getPost();
		if (!isset($data[$this->_formBaseName . '__ctrl'])) {
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
		foreach ($this->getSubForms() as $subForm) {
			if (!$subForm->isValid($this->_request->getPost())) {
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
	 * Maper do zapisu danych.
	 * Dla podformularzy domyślnie wycina prefix z nazwy pola forma, aby
	 * pasował do nazwy kolumny w bazie.
	 * @param array $data
	 * @return array
	 */
	protected function _mapSaveData(array $data = array()) {
		if (!$this->_isSubForm) {
			return $data;
		}
		$data2 = array();
		foreach ($data as $key => $val) {
			$key = str_replace($this->_subFormPrefix, '', $key);
			$data2[$key] = $val;
		}
		return $data2;
	}

	/**
	 * Maper do odczytu danych.
	 * Dla podformularzy domyślnie dodaje prefix do nazwy pola, aby pasował do forma.
	 * @param array $data
	 * @return array
	 */
	protected function _mapLoadData(array $data = array()) {
		if (!$this->_isSubForm) {
			return $data;
		}
		$data2 = array();
		foreach ($data as $key => $val) {
			if (strpos($key, $this->_subFormPrefix) === false) {
				$key = $this->_subFormPrefix . $key;
			}
			$data2[$key] = $val;
		}
		return $data2;
	}

	/**
	 * Czy w modelu wystąpił zapis
	 * @return boolean
	 */
	public function isSaved() {
		return $this->_saved;
	}

	/**
	 * Czy udało się zapisać podformularze
	 * @return boolean
	 */
	public function areSubFormsSaved() {
		return $this->_subFormsSaved;
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
	public function configureFields() {
		foreach ($this->_elements AS $element) {
			$element->__set('id', $this->_formBaseName . '_' . $element->__get('name'));
			$element->__set('class', trim('field ' . $element->__get('class')));
		}
	}

	/**
	 * Ustawia, czy form jest subformem.
	 * @param bool $yes
	 * @return \Mmi\Form
	 */
	public function setIsSubForm($yes = true) {
		$this->_isSubForm = (bool) $yes;
		return $this;
	}

	/**
	 * Zwraca, czy form jest subformem.
	 * @return bool
	 */
	public function getIsSubForm() {
		return $this->_isSubForm;
	}

	/**
	 * Dodaje podformularz
	 * @param \Mmi\Form $form
	 * @param string $name nazwa
	 * @return \Mmi\Form
	 */
	public function addSubForm(\Mmi\Form $form, $name) {
		$form->setIsSubForm(true);
		$this->_subForms[$name] = $form;
		return $this;
	}

	/**
	 * Ustawia podformularze
	 * @param array $subForms tabela nazwa formularza => obiekt formularza
	 * @return \Mmi\Form
	 */
	public function setSubForms(array $subForms) {
		$this->clearSubForms();
		return $this->addSubForms($subForms);
	}

	/**
	 * Dodaje podformularze
	 * @param array $subForms tabela nazwa formularza => obiekt formularza
	 * @return \Mmi\Form
	 */
	public function addSubForms(array $subForms) {
		foreach ($subForms as $formName => $form) {
			$form->setIsSubForm(true);
			$this->_subForms[$formName] = $form;
		}
		return $this;
	}

	/**
	 * Pobiera podformularz
	 * @param string $name nazwa
	 * @return mixed formularz jeśli istnieje lub null jeśli brak
	 */
	public function getSubForm($name) {
		return isset($this->_subForms[$name]) ? $this->_subForms[$name] : null;
	}

	/**
	 * Tabela podformularzy
	 * @return array
	 */
	public function getSubForms() {
		return $this->_subForms;
	}

	/**
	 * Usuwa podformularz
	 * @param string $name
	 * @return \Mmi\Form
	 */
	public function removeSubForm($name) {
		unset($this->_subForms[$name]);
		return $this;
	}

	/**
	 * Czyści podformularze
	 * @return \Mmi\Form
	 */
	public function clearSubForms() {
		$this->_subForms = array();
		return $this;
	}

	/**
	 * Ustawia nazwę kolumny do zapisu powiązania z formularzem rodzicem.
	 * @param string $name
	 * @return \Mmi\Form
	 */
	public function setParentFormColumnName($name) {
		$this->_parentFormColumnName = $name;
		return $this;
	}

	/**
	 * Zwraca nazwę kolumny do zapisu powiązania z formularzem rodzicem.
	 * @return null|string
	 */
	public function getParentFormColumnName() {
		return $this->_parentFormColumnName;
	}

	/**
	 * Zapisuje po kolei wszystkie podformularze.
	 * @return bool
	 */
	public function saveSubForms() {
		$results = true;
		if (!empty($this->_subForms)) {
			foreach ($this->_subForms as $subForm) {
				$saved = $subForm->save();
				if ($saved === false) {
					$results = false;
				}
			}
		}
		$this->_subFormsSaved = $results;
		return $this->_subFormsSaved;
	}

	/**
	 * Zapisuje formularz i następnie po kolei wszystkie podformularze.
	 * @return bool
	 */
	public function saveWithSubForms() {
		//zapis głównego forma
		$this->save();
		if ($this->isSaved()) {
			$results = true;
			//zapis podformów
			if (!empty($this->_subForms)) {
				foreach ($this->_subForms as $subForm) {
					if ($this->getRecordId() && $subForm->getParentFormColumnName()) {
						$subForm->setRecordValue($subForm->getParentFormColumnName(), $this->getRecordId());
					}
					$saved = $subForm->save();
					if ($saved === false) {
						$results = false;
					}
				}
			}
			$this->_subFormsSaved = $results;
			return $this->_subFormsSaved;
		}
		return $this->isSaved();
	}

	/**
	 * Renderer nagłówka formularza
	 * @return string
	 */
	public function start() {
		return '<form id="' . $this->getAttrib('name') .
			'" action="' . ($this->getAttrib('action') ? $this->getAttrib('action') : '#') .
			'" method="' . $this->getAttrib('method') .
			'" enctype="' . $this->getAttrib('enctype') .
			'" class="vertical ' . $this->getAttrib('class') .
			'" accept-charset="' . $this->getAttrib('accept-charset') .
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
	 * @param bool $borders renderowanie początku i zamknięcia formularza
	 * @param bool $renderSub renderowanie submita
	 * @return string
	 */
	public function render($borders = true, $renderSub = true) {
		$html = '';
		if ($borders) {
			$html = $this->start();
		}
		foreach ($this->_elements AS $element) {
			if ($renderSub && ($element->getType() == '\Mmi\Form\Element\Submit' || $element->getType() == '\Mmi\Form\Element\Button')) {
				$html .= $this->renderSubForms();
				$renderSub = false;
			}
			$html .= $element->__toString();
		}

		if ($renderSub) {
			$html .= $this->renderSubForms();
		}
		if ($borders) {
			$html .= $this->end();
		}
		return $html;
	}

	/**
	 * Rendering podformularza
	 * @return string
	 */
	public function renderSubForms() {
		$html = '';
		foreach ($this->getSubForms() as $subForm) {
			$html .= $subForm->render(false);
		}
		return $html;
	}

	/**
	 * Zwraca nazwę obiektu do przypięcia plików
	 * @return string
	 */
	public function getFileObjectName() {
		return $this->_fileObjectName;
	}

	/**
	 * Ustawia nazwę obiektu do przypięcia plików
	 * @param string $name nazwa
	 */
	public function setFileObjectName($name) {
		$this->_fileObjectName = $name;
	}

	/**
	 * Zapis danych do obiektu rekordu
	 * @param array $data
	 * @return boolean
	 */
	protected function _saveRecord($data) {
		unset($data[$this->_formBaseName . '__ctrl']);
		//mapowanie pól z forma na kolumny w bazie
		$data = $this->prepareSaveData($this->_mapSaveData($data));
		//dodatkowe wartości przekazane dla rekordu, np. klucze obce
		if (!empty($this->_recordValues)) {
			$data = array_merge($data, $this->_recordValues);
		}
		$this->_record->setFromArray($data);
		if (method_exists(($this->_record), $this->_recordSaveMethod)) {
			return $this->_record->{$this->_recordSaveMethod}();
		}
		throw new\Exception('Save method unsupported: ' . $this->_recordSaveMethod);
	}

	/**
	 * Dołaczenie plików do obiektu
	 * @param mixed $id
	 * @param array $files tabela plików
	 */
	protected function _appendFiles($id, $files) {
		try {
			foreach ($files as $fileSet) {
				\Cms\Model\File\Dao::appendFiles($this->_fileObjectName, $id, $fileSet);
			}
			\Cms\Model\File\Dao::move('tmp-' . $this->_fileObjectName, \Mmi\Session::getNumericId(), $this->_fileObjectName, $id);
		} catch (\Exception $e) {
			\Mmi\Exception\Logger::log($e);
		}
	}

	/**
	 * Import plików z pól formularza i sesji
	 * Zwraca tabelę danych plików
	 * @return array
	 */
	public function getFiles() {
		$files = array();
		//import z elementów File
		foreach ($this->getElements() as $element) {
			if ($element->getType() != '\Mmi\Form\Element\File') {
				continue;
			}
			if (!$element->isUploaded()) {
				continue;
			}
			$files[$element->getName()] = $element->getFileInfo();
		}
		return $files;
	}

	/**
	 * Zwraca nazwę plików powiązanych z danym formularzem (na podstawie klasy rekordu / modelu)
	 * @param string $name
	 * @return string
	 */
	protected function _classToFileObject($name) {
		$name = explode('\\', $name);
		$fileObject = '';
		foreach ($name as $part) {
			$part = strtolower($part);
			if (isset($first) && $part == $first || $part == 'model' || $part == 'record') {
				continue;
			}
			$first = $part;
			$fileObject .= $part;
		}
		return $fileObject;
	}

}
