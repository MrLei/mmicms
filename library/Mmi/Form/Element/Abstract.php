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
 * Mmi/Form/Element/Abstact.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa elementu formularza
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
abstract class Mmi_Form_Element_Abstract {

	/**
	 * Opcje pola
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Automatyczne tłumaczenie opisów i etykiet pól
	 * @var boolean
	 */
	protected $_translatorEnabled = true;

	/**
	 * Błędy pola
	 * @var array
	 */
	protected $_errors = array();

	/**
	 * Formularz macierzysty
	 * @var Mmi_Form
	 */
	protected $_form = null;

	/**
	 * Kolejność renderowania pola
	 * @var array
	 */
	protected $_renderingOrder = array(
		'fetchLabel', 'fetchField', 'fetchDescription', 'fetchErrors', 'fetchCustomHtml'
	);

	/**
	 * Renderer pola
	 * @return string
	 */
	public function __toString() {
		try {
			$this->preRender();
			$html = $this->fetchBegin();
			foreach ($this->_renderingOrder as $method) {
				if (!method_exists($this, $method)) {
					continue;
				}
				$html .= $this->{$method}();
			}
			$html .= $this->fetchEnd();
		} catch (Exception $e) {
			$html = $e->getMessage();
		}
		return $html;
	}

	/**
	 * Konstruktor, ustawia nazwę pola i opcje
	 * @param string $name nazwa
	 * @param array $options opcje
	 */
	public function __construct($name, array $options = array()) {
		$this->_options = $options;
		if (!isset($this->_options['required'])) {
			$this->_options['required'] = false;
		}
		if (!isset($this->_options['requiredAsterisk'])) {
			$this->_options['requiredAsterisk'] = '*';
		}
		if (!isset($this->_options['markRequired'])) {
			$this->_options['markRequired'] = true;
		}
		if (!isset($this->_options['labelPostfix'])) {
			$this->_options['labelPostfix'] = ':';
		}
		if (!isset($this->_options['ignore'])) {
			$this->_options['ignore'] = false;
		}
		if (isset($this->_options['translatorDisabled']) && $this->_options['translatorDisabled'] == true) {
			$this->setDisableTranslator();
		}
		$this->_options['name'] = $name;
		$this->init();
	}

	/**
	 * Magicznie pobiera wartość z opcji
	 * @param string $key klucz
	 * @return mixed
	 */
	public final function __get($key) {
		return isset($this->_options[$key]) ? $this->_options[$key] : null;
	}

	/**
	 * Magicznie ustawia wartość w opcjach
	 * @param string $key klucz
	 * @param mixed $value wartość
	 */
	public final function __set($key, $value) {
		$this->_options[$key] = $value;
	}

	/**
	 * Magicznie sprawdza istnienie opcji o danym kluczu
	 * @param klucz $key string
	 * @return boolean
	 */
	public final function __isset($key) {
		return isset($this->_options[$key]);
	}

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {

	}

	/**
	 * Funkcja użytkownika, jest wykonywana przed renderingiem
	 */
	public function preRender() {

	}

	/**
	 * Ustawia nazwę pola formularza
	 * @param mixed $name wartość
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setName($name) {
		$this->_options['name'] = $name;
		return $this;
	}

	/**
	 * Ustawia wartość pola formularza
	 * @param mixed $value wartość
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setValue($value) {
		$this->_options['value'] = $value;
		return $this;
	}

	/**
	 * Ustawia form macierzysty
	 * @param Mmi_Form $form
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setForm(Mmi_Form $form) {
		$this->_form = $form;
		return $this;
	}

	/**
	 * Pobranie formularza macierzystego
	 * @return Mmi_Form
	 */
	public final function getForm() {
		return $this->_form;
	}

	/**
	 * Ustaw kolejność realizacji
	 * @param array $renderingOrder
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setRenderingOrder(array $renderingOrder = array()) {
		foreach ($renderingOrder as $method) {
			if (!method_exists($this, $method)) {
				throw new Exception('Unknown rendering method');
			}
		}
		$this->_renderingOrder = $renderingOrder;
		return $this;
	}

	/**
	 * Wyłącza ajax dla formularza
	 * @param bool $disable default: true
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setAjaxDisable($disable = true) {
		$this->_options['noAjax'] = $disable;
		return $this;
	}

	/**
	 * Ustawia opis
	 * @param string $description
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setDescription($description) {
		$this->_options['description'] = $description;
		return $this;
	}

	/**
	 * Ustawia placeholder (HTML5)
	 * @param string $placeholder
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setPlaceholder($placeholder) {
		$this->_options['placeholder'] = $placeholder;
		return $this;
	}

	/**
	 * Dodaje filtr
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function addFilter($name, array $options = array()) {
		if (!isset($this->_options['filters']) || !is_array($this->_options['filters'])) {
			$this->_options['filters'] = array();
		}
		$this->_options['filters'][] = array('filter' => $name, 'options' => $options);
		return $this;
	}

	/**
	 * Ustawia ignorowanie pola
	 * @param bool $ignore
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setIgnore($ignore = true) {
		$this->_options['ignore'] = ($ignore ? true : false);
		return $this;
	}

	/**
	 * Ustawia wyłączenie pola
	 * @param bool $disabled
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setDisabled($disabled = true) {
		if ($disabled) {
			$this->_options['disabled'] = '';
		}
		return $this;
	}

	/**
	 * Ustawia pole do odczytu
	 * @param readOnly $disable
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setReadOnly($readOnly = true) {
		if ($readOnly) {
			$this->_options['readonly'] = '';
		}
		return $this;
	}

	/**
	 * Ustawia label pola
	 * @param string $label
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setLabel($label) {
		$this->_options['label'] = $label;
		return $this;
	}

	/**
	 * Ustawia postfix labela
	 * @param string $labelPostfix
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setLabelPostfix($labelPostfix) {
		$this->_options['labelPostfix'] = $labelPostfix;
		return $this;
	}

	/**
	 * Ustawia wymagalność pola
	 * @param bool $markRequired
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setMarkRequired($markRequired = true) {
		$this->_options['markRequired'] = ($markRequired ? true : false);
		return $this;
	}

	/**
	 * Ustawia czy pole jest wymagane
	 * @param bool $value
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setRequired($required = true) {
		$this->_options['required'] = $required;
		return $this;
	}

	/**
	 * Ustawia symbol gwiazdki pól wymaganych
	 * @param string $symbol
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setRequiredAsterisk($symbol) {
		$this->_options['requiredAsterisk'] = $symbol;
		return $this;
	}

	/**
	 * Ustawia wszystkie opcje wyboru na podstawie tabeli
	 * @param array $multiOptions opcje
	 * @return Mmi_Form_Element_Abstract
	 */
	public function setMultiOptions(array $multiOptions = array()) {
		$this->_options['multiOptions'] = $multiOptions;
		return $this;
	}

	/**
	 * Dodaje opcję wyboru
	 * @param string $value wartość
	 * @param string $caption nazwa
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addMultiOption($value, $caption) {
		if (!isset($this->_options['multiOptions']) || !is_array($this->_options['multiOptions'])) {
			$this->_options['multiOptions'] = array();
		}
		$this->_options['multiOptions'][$value] = $caption;
		return $this;
	}

	/**
	 * Ustawia dowolną opcję
	 * @param string $key klucz
	 * @param string $value wartość
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setOption($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}

	/**
	 * Dodaje walidator
	 * @param string $value nazwa
	 * @param string $options opcje
	 * @param string $message wiadomość
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidator($name, array $options = array(), $message = null) {
		if (!isset($this->_options['validators']) || !is_array($this->_options['validators'])) {
			$this->_options['validators'] = array();
		}
		$validator = array('validator' => $name, 'options' => $options);
		if ($message !== null) {
			$validator['message'] = $message;
		}
		$this->_options['validators'][] = $validator;
		return $this;
	}

	/**
	 * Dodaje walidator alfanumeryczny
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorAlnum($message = null) {
		return $this->addValidator('alnum', array(), $message);
	}

	/**
	 * Dodaje walidator dat
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorDate($message = null) {
		return $this->addValidator('date', array(), $message);
	}

	/**
	 * Dodaje walidator e-maili
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorEmailAddress($message = null) {
		return $this->addValidator('emailAddress', array(), $message);
	}

	/**
	 * Dodaje walidator równości z wartością
	 * @param mixed $value wartość porównania
	 * @param bool $isCheckbox czy checkbox
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorEqual($value, $isCheckbox = false, $message = null) {
		$isCheckbox = ($isCheckbox === true) ? true : false;
		return $this->addValidator('equal', array('value' => $value, 'checkbox' => $isCheckbox), $message);
	}

	/**
	 * Dodaje walidator numerów IBAN
	 * @param string $countryPrefix kod kraju np. GB, PL
	 * @param array $allowedCountries lista dozwolonych prefixów
	 * @param $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorIban($countryPrefix = 'PL', array $allowedCountries = array(), $message = null) {
		return $this->addValidator('iban', array($countryPrefix, $allowedCountries), $message);
	}

	/**
	 * Walidacja całkowitych
	 * @param bool $positive czy tylko naturalne
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorInteger($positive = false, $message = null) {
		return $this->addValidator('integer', array('positive' => $positive), $message);
	}

	/**
	 * Walidacja udziału wielkich liter
	 * @param int $percent maksymalny udział
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorLargeSmall($percent = 40, $message = null) {
		return $this->addValidator('largeSmall', array($percent), $message);
	}

	/**
	 * Walidacja wypełnienia pola
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorNotEmpty($message = null) {
		return $this->addValidator('notEmpty', array(), $message);
	}

	/**
	 * Walidacja od/do
	 * @param mixed $from większa od
	 * @param mixed $to mniejsza od
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorValueBetween($from = null, $to = null, $message = null) {
		return $this->addValidator('numberBetween', array($from, $to), $message);
	}

	/**
	 * Walidacja numeryczna
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorNumeric($message = null) {
		return $this->addValidator('numeric', array(), $message);
	}

	/**
	 * Walidacja numeryczna
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorPostal($message = null) {
		return $this->addValidator('postal', array(), $message);
	}

	/**
	 * Walidacja unikalności rekordu
	 * @param Mmi_Dao $dao DAO
	 * @param string $fieldName nazwa pola
	 * @param int $id identyfikator istniejącego pola (domyślnie null)
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorRecordUnique($dao, $fieldName, $id = null, $message = null) {
		return $this->addValidator('recordUnique', array($dao, $fieldName, $id), $message);
	}

	/**
	 * Walidacja regex
	 * @param string $pattern wzorzec
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorRegex($pattern, $message = null) {
		return $this->addValidator('regex', array($pattern), $message);
	}

	/**
	 * Walidacja długości ciągu znaków
	 * @param int $from długość od
	 * @param int $to długość do
	 * @param string $message opcjonalny komunikat błędu
	 * @return Mmi_Form_Element_Abstract
	 */
	public function addValidatorStringLength($from, $to, $message = null) {
		return $this->addValidator('stringLength', array(intval($from), intval($to)), $message);
	}

	/**
	 * Ustawia html użytkownika
	 * @param string $html
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setCustomHtml($html) {
		$this->_options['customHtml'] = $html;
		return $this;
	}

	/**
	 * Wyłącza translator
	 * @param boolean $disable
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function setDisableTranslator($disable = true) {
		$this->_translatorEnabled = !$disable;
		return $this;
	}

	/**
	 * Pobiera wartość pola formularza
	 * @return mixed
	 */
	public final function getValue() {
		return isset($this->_options['value']) ? $this->_options['value'] : null;
	}

	/**
	 * Pobiera nazwę pola formularza
	 * @return mixed
	 */
	public final function getName() {
		return isset($this->_options['name']) ? $this->_options['name'] : null;
	}

	/**
	 * Pobiera typ pola
	 * @return string
	 */
	public final function getType() {
		return get_class($this);
	}

	/**
	 * Pobiera walidatory
	 * @return array
	 */
	public final function getValidators() {
		return isset($this->_options['validators']) ? $this->_options['validators'] : array();
	}

	/**
	 * Pobiera translator
	 * @return Mmi_Translate
	 */
	public final function getTranslate() {
		$translate = Mmi_Controller_Front::getInstance()->getView()->getTranslate();
		return (null === $translate) ? new Mmi_Translate() : $translate;
	}

	/**
	 * Zwraca czy pole jest ignorowane
	 * @return boolean
	 */
	public final function isIgnored() {
		return (isset($this->_options['ignore']) && $this->_options['ignore']) ? true : false;
	}

	/**
	 * Zwraca czy pole jest wymagane
	 * @return boolean
	 */
	public final function isRequired() {
		return (isset($this->_options['required']) && $this->_options['required']) ? true : false;
	}

	/**
	 * Zwraca multi opcje pola
	 * @return array
	 */
	public function getMultiOptions() {
		return isset($this->_options['multiOptions']) ? $this->_options['multiOptions'] : array();
	}

	/**
	 * Filtruje daną wartość za pomocą filtrów pola
	 * @param mixed $value wartość
	 * @return mixed wynik filtracji
	 */
	public final function applyFilters($value) {
		if (!isset($this->_options['filters'])) {
			return $value;
		}
		if (!is_array($this->_options['filters'])) {
			return $value;
		}
		foreach ($this->_options['filters'] as $filter) {
			$options = array();
			if (is_array($filter)) {
				$options = isset($filter['options']) ? $filter['options'] : array();
				$filter = $filter['filter'];
			}
			$f = $this->_getFilter($filter);
			$f->setOptions($options);
			$value = $f->filter($value);
		}
		return $value;
	}

	/**
	 * Waliduje pole i zwraca czy wpis w polu jest poprawny
	 * @return boolean
	 */
	public final function isValid() {
		$result = true;
		//waliduje poprawnie jeśli niewymagane, ale tylko gdy niepuste
		if (!($this->_options['required'] || $this->value != '')) {
			return true;
		}
		if (!is_array($this->getValidators())) {
			return true;
		}
		foreach ($this->getValidators() as $validator) {
			$options = array();
			$message = null;
			if (is_array($validator)) {
				$options = isset($validator['options']) ? $validator['options'] : array();
				$message = isset($validator['message']) ? $validator['message'] : null;
				$validator = $validator['validator'];
			}
			$v = $this->_getValidator($validator);
			$v->setOptions($options);
			if (!$v->isValid($this->value)) {
				$result = false;
				$this->_errors[] = ($message !== null) ? $message : $v->getError();
			}
		}
		return $result;
	}

	/**
	 * Zwraca czy pole ma błędy
	 * @return boolean
	 */
	public final function hasErrors() {
		return !empty($this->_errors);
	}

	/**
	 * Pobiera błędy pola
	 * @return array
	 */
	public final function getErrors() {
		return $this->_errors;
	}

	/**
	 * Dodaje błąd
	 * @param string $error
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function addError($error) {
		$this->_errors[] = $error;
		return $this;
	}

	/**
	 * Dodaje klasę do elementu
	 * @param string $className nazwa klasy
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function addClass($className) {
		if (!isset($this->_options['class'])) {
			$this->_options['class'] = '';
		}
		$this->_options['class'] = trim($this->_options['class'] .= ' ' . $className);
		return $this;
	}

	/**
	 * Buduje kontener pola (początek)
	 * @return string
	 */
	public final function fetchBegin() {
		if (isset($this->_options['id'])) {
			$idHtml = 'id="' . $this->_options['id'] . '_container"';
		} else {
			$idHtml = '';
		}
		$class = get_class($this);
		$class = strtolower(substr($class, strrpos($class, '_') + 1));
		if ($this->hasErrors()) {
			$class .= ' error';
		}
		return '<div class="' . trim($this->class . ' ' . $class) . '" ' . $idHtml . '>';
	}

	/**
	 * Buduje kontener pola (koniec)
	 * @return string
	 */
	public final function fetchEnd() {
		return '<div class="clear"></div></div>' . PHP_EOL;
	}

	/**
	 * Buduje etykietę pola
	 * @return string
	 */
	public function fetchLabel() {
		if (!isset($this->_options['label'])) {
			return;
		}
		if (isset($this->_options['id'])) {
			$forHtml = ' for="' . $this->_options['id'] . '" id="' . $this->_options['id'] . '_label"';
		} else {
			$forHtml = '';
		}
		if (isset($this->_options['required']) && $this->_options['required'] && isset($this->_options['markRequired']) && $this->_options['markRequired']) {
			$requiredClass = ' class="required"';
			$required = '<span class="required">' . $this->_options['requiredAsterisk'] . '</span>';
		} else {
			$requiredClass = '';
			$required = '';
		}
		if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
			$label = $this->getTranslate()->_($this->_options['label']);
		} else {
			$label = $this->_options['label'];
		}
		return '<label' . $forHtml . $requiredClass . '>' . $label . $this->_options['labelPostfix'] . $required . '</label>';
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public abstract function fetchField();

	/**
	 * Buduje opis pola
	 * @return string
	 */
	public final function fetchDescription() {
		if (!isset($this->_options['description'])) {
			return;
		}
		if (isset($this->_options['id'])) {
			$id = ' id="' . $this->_options['id'] . '_description"';
		} else {
			$id = '';
		}
		if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
			$description = $this->getTranslate()->_($this->_options['description']);
		} else {
			$description = $this->_options['description'];
		}
		return '<div' . $id . ' class="description">' . $description . '</div>';
	}

	/**
	 * Buduje błędy pola
	 * @return string
	 */
	public final function fetchErrors() {
		if (isset($this->_options['id'])) {
			$idHtml = ' id="' . $this->_options['id'] . '_errors"';
		} else {
			$idHtml = '';
		}
		$html = '<div class="errors"' . $idHtml . '>';
		if ($this->hasErrors()) {
			$html .= '<span class="marker"></span>'
				  .  '<ul>'
				  .		'<li class="point first"></li>';
			foreach ($this->_errors as $error) {
				if ($this->_translatorEnabled && ($this->getTranslate() !== null)) {
					$err = $this->getTranslate()->_($error);
				} else {
					$err = $error;
				}
				$html .= '<li class="notice error"><i class="icon-remove-sign icon-large"></i>' . $err . '</li>';
			}
			$html .=	'<li class="close last"></li>'
				  .  '</ul>';
		}
		$html .= '<div class="clear"></div></div>';
		return $html;
	}

	/**
	 * Buduje wstrzyknięty kod użytkownika
	 * @return string
	 */
	public final function fetchCustomHtml() {
		if (!isset($this->_options['customHtml'])) {
			return;
		}
		return $this->_options['customHtml'];
	}

	/**
	 * Pobiera obiekt filtra
	 * @param string $name nazwa filtra
	 * @return Mmi_Filter_Interface
	 */
	protected final function _getFilter($name) {
		$name = ucfirst($name);
		$structure = Mmi_Controller_Front::getInstance()->getStructure('library');
		foreach ($structure as $libName => $lib) {
			if (isset($lib['Filter'][$name])) {
				$className = $libName . '_Filter_' . $name;
			}
		}
		if (!isset($className)) {
			throw new Exception('Unknown filter: ' . $name);
		}
		return new $className();
	}

	/**
	 * Pobiera nazwę walidatora
	 * @param string $name nazwa walidatora
	 * @return Mmi_Validate_Abstract
	 */
	protected final function _getValidator($name) {
		$name = ucfirst($name);
		$structure = Mmi_Controller_Front::getInstance()->getStructure('library');
		foreach ($structure as $libName => $lib) {
			if (isset($lib['Validate'][$name])) {
				$className = $libName . '_Validate_' . $name;
			}
		}
		if (!isset($className)) {
			throw new Exception('Unknown validator: ' . $name);
		}
		return new $className();
	}

	/**
	 * Buduje opcje HTML
	 * @return string
	 */
	protected final function _getHtmlOptions() {
		$options = $this->_options;
		if (isset($options['validators']) && !isset($options['noAjax'])) {
			$options['class'] = trim((isset($options['class']) ? $options['class'] . ' validate' : 'validate'));
		}
		unset($options['description']);
		unset($options['filters']);
		unset($options['ignore']);
		unset($options['label']);
		unset($options['labelPostfix']);
		unset($options['labelAsterisk']);
		unset($options['markRequired']);
		unset($options['multiOptions']);
		unset($options['labelClass']);
		unset($options['required']);
		unset($options['requiredAsterisk']);
		unset($options['translatorDisabled']);
		unset($options['validators']);
		unset($options['customHtml']);
		unset($options['count']);
		if (isset($options['disabled']) && is_array($options['disabled']) && empty($options['disabled'])) {
			unset($options['disabled']);
		}
		$html = '';
		foreach ($options as $key => $value) {
			$html .= $key . '="' . str_replace('"', '&quot;', $value) . '" ';
		}
		return $html;
	}

}
