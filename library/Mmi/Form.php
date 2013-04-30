<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Form.php
 * @category   Mmi
 * @package    Mmi_Form
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa formularza
 * @category   Mmi
 * @package    Mmi_Form
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Form {

	/**
	 * Nazwa formularza
	 * @var string
	 */
	protected $_formBaseName;

	/**
	 * Referencja do requestu
	 * @var Mmi_Controller_Request
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
	 * Identyfikator obiektu w modelu
	 * @var mixed
	 */
	protected $_modelId;

	/**
	 * Nazwa metody zapisu w modelu
	 * @var string
	 */
	protected $_modelSaveMethod = 'save';

	/**
	 * Nazwa rekordu
	 * @var string 
	 */
	protected $_recordName;
	
	/**
	 * Obiekt rekordu
	 * @var Mmi_Dao_Record 
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
	 * @var type 
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
	 * Podformularze
	 * @var array
	 */
	protected $_subForms = array();

	/**
	 * Rezultat walidacji
	 * @var bool
	 */
	protected $_validationResult = null;

	/**
	 * Namespace powiązany z tym formularzem
	 * @var Mmi_Session_Namespace
	 */
	protected $_sessionNamespace = null;

	/**
	 * Konstruktor
	 * @param mixed $id identyfikator modelu
	 * @param array $options opcje
	 */
	public function __construct($id = null, array $options = array(), $className = null) {
		$this->_options = $options;
		$this->_modelId = $id;
		$this->_recordId = $id;
		$className = isset($className) ? $className : get_class($this);

		//kalkulacja nazwy plików dla active record
		if ($this->_recordName) {
			$this->_fileObjectName = $this->_classToFileObject($this->_recordName);
		}

		$this->_request = Mmi_Controller_Front::getInstance()->getRequest();

		if (!$this->getAttrib('name')) {
			$this->_formBaseName = strtolower(substr($className, strrpos($className, '_') + 1));
		} else {
			$this->_formBaseName = $this->getAttrib('name');
		}
		$view = Mmi_View::getInstance();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/form.js');

		$this->setAttrib('name', 'form_' . $this->_formBaseName);
		$this->setAttrib('class', 'form_' . $this->_formBaseName);
		$this->setAttrib('accept-charset', 'utf-8');
		$this->setAttrib('method', 'post');
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->_saved = false;
		$this->_savedId = null;
		//dane z post
		if ($this->isMine()) {
			$data = $this->_request->getPost();
		}
		if ($this->hasRecord() && $id !== null && !isset($data)) {
			$data = $this->_record->toArray();
			$this->_values = $this->prepareLoadData($data);
		} elseif (isset($data)) {
			$this->_values = $data;
		}
		$this->init();
		//obsługa checkboxów i selectów
		if (!empty($this->_values)) {
			foreach ($this->getElements() as $element) {
				if ($element->getType() == 'Mmi_Form_Element_Checkbox' && !isset($this->_values[$element->name]) && $this->isMine()) {
					$this->_values[$element->name] = 0;
				}
				if ($element->getType() == 'Mmi_Form_Element_Select' && $this->isMine()) {
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
			$this->_hash = sha1(Mmi_Config::get('gloabal', 'salt') . $className . microtime(true));
		} else {
			$this->_hash = sha1(Mmi_Config::get('gloabal', 'salt') . $className);
		}

		$this->addElement('hidden', $this->_formBaseName . '__ctrl', array(
			'id' => $this->_formBaseName . '__ctrl',
			'ignore' => true,
			'value' => Mmi_Lib::hashTable(array('hash' => $this->_hash, 'class' => $className, 'options' => $this->_options))
		));

		if (!isset($options['ajax']) && $this->_secured) {
			$this->_sessionNamespace = new Mmi_Session_Namespace('Mmi_Form');
			$hash = $this->_sessionNamespace->{$this->_formBaseName};
			$this->_sessionNamespace->{$this->_formBaseName} = $this->_hash;
			$this->_hash = $hash;
		}

		if ($this->isMine()) {
			$values = array();
			$validatorData = array();
			$values[$this->_formBaseName . '__ctrl'] = isset($this->_values[$this->_formBaseName . '__ctrl']) ? $this->_values[$this->_formBaseName . '__ctrl'] : null;
			foreach ($this->_values as $key => $value) {
				$element = $this->getElement($key);
				if ($element !== null) {
					if (!$element->isIgnored()) {
						$values[$key] = $element->applyFilters($value);
					}
					$validatorData[$key] = $element->applyFilters($value);
				}
			}
			$this->_values = $values;
			//zapis danych do aktywnego rekordu
			if ($this->_request->isPost() && $this->isValid($validatorData) && $this->hasRecord()) {
				//zapis do rekordu
				$this->_saved = $this->_saveRecord($this->_values);
				if ($this->_saved === true) {
					if (null != $this->_sessionNamespace) {
						$this->_sessionNamespace->unsetAll();
					}
					$this->_appendFiles($this->_record->getPk(), $this->_importFiles());
					$this->_modelId = $this->_record->getPk();
				}
			}

		}
		$this->setDefaults($this->_values);
		$this->lateInit();
	}

	/**
	 * Inicjalizacja formularza
	 * @see Mmi_Form::lateInit();
	 */
	abstract public function init();

	/**
	 * Metoda użytkownika wykonywana na koniec konstruktora
	 */
	public function lateInit() {
		
	}

	/**
	 * Dodawanie elementu formularza
	 * @param string $type nazwa typu
	 * @param string $name nazwa pola
	 * @param array $options opcje
	 */
	public function addElement($type, $name, array $options = array()) {
		$className = 'Mmi_Form_Element_' . ucfirst($type);
		$this->_elements[$name] = new $className($name, $options);
		$this->_elements[$name]->setForm($this);
	}

	/**
	 * Dodawanie elementu formularza z gotowego obiektu
	 * @param Mmi_Form_Element_Abstract $element obiekt elementu formularza
	 */
	public function addElementObject(Mmi_Form_Element_Abstract $element) {
		$this->_elements[$element->getName()] = $element;
		$this->_elements[$element->getName()]->setForm($this);
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
	 * @return Mmi_Form_Element_Abstract
	 */
	public function getElement($name) {
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
	 * @return Mmi_Form
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
	 * Pobiera translator
	 * @return Mmi_Translate
	 */
	public function getTranslator() {
		return Mmi_Registry::get('Mmi_Translate');
	}

	/**
	 * Ustawia akcję formularza
	 * @param string $value akcja
	 */
	public function setAction($value) {
		$this->setAttrib('action', $value);
	}

	/**
	 * Magiczny getter elementów
	 * @param string $key nazwa pola
	 * @return Mmi_Form_Element_Abstract
	 */
	public function __get($key) {
		return isset($this->_elements[$key]) ? $this->_elements[$key] : null;
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
	 * @return Mmi_Dao_Record
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
		if ($this->_record instanceof Mmi_Dao_Record) {
			return true;
		}
		if ($this->_record !== null) {
			throw new Exception('Invalid record supplied');
		}
		$recordName = $this->_recordName;
		$this->_record = new $recordName($this->_modelId);
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
		$options = Mmi_Lib::unhashTable($data[$this->_formBaseName . '__ctrl']);
		if ($options['class'] != get_class($this)) {
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
	 * Czy w modelu wystąpił zapis
	 * @return boolean
	 */
	public function isSaved() {
		return $this->_saved;
	}

	/**
	 * Identyfikator zapisanego obiektu
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
	 * Dodaje podformularz
	 * @param Mmi_Form $form
	 * @param string $name nazwa
	 * @return Mmi_Form
	 */
	public function addSubForm(Mmi_Form $form, $name) {
		$this->_subForms[$name] = $form;
		return $this;
	}

	/**
	 * Ustawia podformularze
	 * @param array $subForms tabela nazwa formularza => obiekt formularza
	 * @return Mmi_Form
	 */
	public function setSubForms(array $subForms) {
		$this->clearSubForms();
		return $this->addSubForms($subForms);
	}

	/**
	 * Dodaje podformularze
	 * @param array $subForms tabela nazwa formularza => obiekt formularza
	 * @return Mmi_Form
	 */
	public function addSubForms(array $subForms) {
		foreach ($subForms as $formName => $form) {
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
	 * @return Mmi_Form
	 */
	public function removeSubForm($name) {
		unset($this->_subForms[$name]);
		return $this;
	}

	/**
	 * Czyści podformularze
	 * @return Mmi_Form
	 */
	public function clearSubForms() {
		$this->_subForms = array();
		return $this;
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
			'" class="' . $this->getAttrib('class') .
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
	 * @param bool borders renderowanie początku i zamknięcia formularza
	 * @return string
	 */
	public function render($borders = true, $renderSub = true) {
		$html = '';
		if ($borders) {
			$html = $this->start();
		}
		foreach ($this->_elements AS $element) {
			if ($renderSub && ($element->getType() == 'Mmi_Form_Element_Submit' || $element->getType() == 'Mmi_Form_Element_Button')) {
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
		$this->_record->setFromArray($this->prepareSaveData($data), false);
		if (method_exists(($this->_record), $this->_recordSaveMethod)) {
			return $this->_record->{$this->_recordSaveMethod}();
		}
		throw new Exception('Save method unsupported: ' . $this->_recordSaveMethod);
	}

	/**
	 * Dołaczenie plików do obiektu
	 * @param mixed $id
	 */
	protected function _appendFiles($id, $files) {
		try {
			Cms_Model_File_Dao::appendFiles($this->_fileObjectName, $id, $files);
			Cms_Model_File_Dao::move('tmp-' . $this->_fileObjectName, Mmi_Session::getNumericId(), $this->_fileObjectName, $id);
		} catch (Exception $e) {
			
		}
	}

	/**
	 * Import plików z pól formularza i sesji
	 * Zwraca tabelę danych plików
	 * @return array
	 */
	protected function _importFiles() {
		$files = array();
		//import z elementów File
		foreach ($this->getElements() as $element) {
			if ($element->getType() != 'Mmi_Form_Element_File') {
				continue;
			}
			if (!$element->isUploaded()) {
				continue;
			}
			$files = $element->getFileInfo();
		}
		return $files;
	}

	/**
	 * Zwraca nazwę plików powiązanych z danym formularzem (na podstawie klasy rekordu / modelu)
	 * @param type $name
	 * @return string
	 */
	protected function _classToFileObject($name) {
		$name = explode('_', $name);
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
