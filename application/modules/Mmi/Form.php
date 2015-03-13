<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

/**
 * Abstrakcyjna klasa formularza
 * wymaga zdefiniowania metody init()
 * w metodzie init należy skonfigurować pola formularza
 */
abstract class Form extends \Mmi\OptionObject {

	/**
	 * Elementy formularza
	 * @var array
	 */
	protected $_elements = array();

	/**
	 * Nazwa formularza
	 * @var string
	 */
	protected $_formBaseName;

	/**
	 * CTRL pochodzący z POST
	 * @var string
	 */
	protected $_ctrl;

	/**
	 * Czy włączone zabezpieczenie csrf
	 * @var boolean
	 */
	protected $_secured = false;

	/**
	 * Obiekt rekordu
	 * @var \Mmi\Dao\Record
	 */
	protected $_record;

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
	 * Konstruktor
	 * @param \Mmi\Dao\Record $record obiekt recordu
	 * @param array $options opcje
	 */
	public function __construct(\Mmi\Dao\Record $record = null, array $options = array()) {
		$this->setOptions($options);
		$this->_record = $record;
		$class = get_class($this);
		$this->_formBaseName = strtolower(substr($class, strrpos($class, '\\') + 1));
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
			$data = \Mmi\Controller\Front::getInstance()
				->getRequest()
				->getPost()
				->toArray();
		}

		//inicjalizacja formularza
		$this->init();

		//dodawanie CTRL
		$this->addElementHidden($this->_formBaseName . '__ctrl')
			->setIgnore()
			->setOption('id', $this->_formBaseName . '__ctrl');

		//jeśli przyszły dane - ustawienie w pola
		if (isset($data)) {
			//ustawienie wartości domyślnych
			$this->setDefaults($this->prepareLoadData($data));
		}

		//zapis do rekordu jeśli istnieje
		$this->save();

		//wywoływanie metody użytkownika (po zapisie)
		$this->lateInit();

		//nowy hash
		$hash = '';
		if ($this->_secured) {
			\Mmi\Session\Space::factory('\Mmi\Form')->{$this->_formBaseName} = ($hash = md5($class . microtime(true)));
		}

		//ustawianie nowego ctrl
		$this->getElement($this->_formBaseName . '__ctrl')
			->setValue(\Mmi\Lib::hashTable(array('hash' => $hash, 'class' => $class, 'recordClass' => $this->getRecordClass(), 'id' => $this->getRecordClass() ? $this->getRecord()->id : null, 'options' => $this->getOptions())));
	}

	/**
	 * Inicjalizacja formularza przez programistę końcowego
	 */
	abstract public function init();

	/**
	 * Metoda użytkownika wykonywana na koniec konstruktora
	 */
	public function lateInit() {
		
	}

	/**
	 * Metoda walidacji całego formularza (domyślnie zawsze przechodzi)
	 * @return boolean
	 */
	public function validator() {
		return true;
	}

	/**
	 * Ustawia akcję formularza
	 * @param string $value akcja
	 * @return \Mmi\Form
	 */
	public function setAction($value) {
		return $this->setOption('action', $value);
	}

	/**
	 * Ustawia zabezpieczenie CSRF
	 * @param boolean $secured
	 */
	public function setSecured($secured = true) {
		$this->_secured = $secured;
	}

	/**
	 * Dodawanie elementu formularza z gotowego obiektu
	 * @param \Mmi\Form\Element\ElementAbstract $element obiekt elementu formularza
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public function addElement(\Mmi\Form\Element\ElementAbstract $element) {
		return $this->_elements[$element->getName()] = $element
			//ustawianie opcji na elemencie
			->setForm($this)
			->setOption('id', $this->_formBaseName . '_' . $element->getName())
			->setOption('class', 'field ' . $element->getOption('class'));
	}

	/**
	 * Pobranie elementów formularza
	 * @return \Mmi\Form\Element\ElementAbstract[]
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
	 * Zwraca czy dane POST są przeznaczone dla tego formularza
	 * @return boolean
	 */
	public function isMine() {
		return \Mmi\Controller\Front::getInstance()
				->getRequest()
				->getPost()
				->__isset($this->_formBaseName . '__ctrl');
	}

	/**
	 * Walidacja formularza
	 * @return boolean
	 */
	public function isValid() {
		//dane nie od danego formularza
		if (!$this->isMine()) {
			return false;
		}

		//odczytywanie danych CTRL
		$options = \Mmi\Lib::unhashTable($this->_ctrl);

		//sprawdzenie zgodności klas z CTRL z bieżącą klasą
		if ($options['class'] != get_class($this)) {
			return false;
		}
		//jeśli form zabezpieczony przed CSRF, sprawdzenie hash
		if ($this->_secured) {
			return $options['hash'] == \Mmi\Session\Space::factory('\Mmi\Form')->{$this->_formBaseName};
		}
		$validationResult = true;
		//walidacja poszczególnych elementów formularza
		foreach ($this->getElements() as $element) {
			//jeśli nieprawidłowy walidacja trwa dalej, ale wynik jest już negatywny
			if (!$element->isValid()) {
				$validationResult = false;
			}
		}
		return $validationResult;
	}

	/**
	 * Ustawienie wartości pól
	 * @param mixed $data
	 * @return \Mmi\Form
	 */
	public function setDefaults(array $data = array()) {
		//sprawdzenie wartości dla wszystkich elementów
		foreach ($this->getElements() as $element) {
			$value = isset($data[$element->getName()]) ? $data[$element->getName()] : null;
			//selecty multiple dostają pusty array jeśli brak wartości
			if ($element instanceof \Mmi\Form\Element\Select && $element->getOption('multiple') && null == $value) {
				$element->setValue($element->getValue() ? $element->getValue() : array());
				continue;
			}
			//checkboxy na 0 jeśli nie ustawione
			if ($element instanceof \Mmi\Form\Element\Checkbox && null == $value) {
				$element->setValue(0);
				continue;
			}
			//jeśli brak wartości
			if (null == $value) {
				continue;
			}
			//ustawianie CTRL
			if ($element->getName() == $this->_formBaseName . '__ctrl') {
				$this->_ctrl = $value;
				continue;
			}
			//ustawianie wartości
			$element->setValue($data[$element->getName()]);
		}
		return $this;
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
	 * Zwraca obiekt aktywnego rekordu
	 * @return \Mmi\Dao\Record
	 */
	public function getRecord() {
		return $this->_record;
	}

	/**
	 * Pobiera nazwę klasy rekordu
	 * @return string
	 */
	public function getRecordClass() {
		if (!$this->hasRecord()) {
			return;
		}
		return get_class($this->_record);
	}

	/**
	 * Czy do formularza przypisany jest active record, jeśli nie, a podana jest nazwa, stworzy obiekt rekordu
	 * @return boolean
	 */
	public function hasRecord() {
		return $this->_record instanceof \Mmi\Dao\Record;
	}

	/**
	 * Sprawdza czy rekord zawiera dane
	 * @return boolean
	 */
	public function hasNotEmptyRecord() {
		//jeśli brak rekordu to brak także niepustego rekordu
		if (!$this->hasRecord()) {
			return false;
		}
		//jeśli w rekordzie istnieje choć jedno pole nie będące nullem, zwraca prawdę
		foreach ($this->_record->toArray() as $k => $v) {
			if ($v !== null) {
				return true;
			}
		}
		//wszystkie pola null
		return false;
	}

	/**
	 * Wywołuje walidację i zapis rekordu powiązanego z formularzem.
	 * @return bool
	 */
	public function save() {
		//jeśli brak rekordu save nie jest wykonywany
		if (!$this->hasRecord()) {
			return $this->_saved = false;
		}
		//jeśli formularz nieprawidłowy
		if (!$this->isValid()) {
			return $this->_saved = false;
		}
		//wywołanie zapisu rekordu
		$this->_saved = $this->_saveRecord();
		if ($this->_saved === false) {
			return false;
		}
		return $this->_saved;
	}

	/**
	 * Zapis danych do obiektu rekordu
	 * @return boolean
	 */
	protected function _saveRecord() {
		//metoda nie istnieje
		if (!method_exists(($this->_record), $this->_recordSaveMethod)) {
			throw new \Exception('\Mmi\Form: save method not found: ' . $this->_recordSaveMethod);
		}
		$data = array();
		//pobieranie danych z elementów
		foreach ($this->getElements() as $element) {
			//ignorowanie CTRL
			if ($element->getName() == $this->_formBaseName . '__ctrl') {
				continue;
			}
			//dodawanie wartości do tabeli
			$data[$element->getName()] = $element->getValue();
		}
		//ustawianie rekordu na podstawie danych
		$this->_record->setFromArray($this->prepareSaveData($data));
		//wywołanie metody zapisu na rekordzie
		return $this->_record->{$this->_recordSaveMethod}();
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
		//rendering poszczególnych elementów
		foreach ($this->_elements AS $element) {
			/* @var $element \Mmi\Form\Element\ElementAbstract */
			$html .= $element->__toString();
		}
		return $html . $this->end();
	}

	/**
	 * Renderer formularza
	 * Renderuje bezpośrednio, lub z szablonu
	 * @return string
	 */
	public function __toString() {
		//nie rzuci wyjątkiem, gdyż wyjątki są wyłapane w elementach
		return $this->render();
	}

	//skróty w interfejsie

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
