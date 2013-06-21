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
 * Mmi/Form/Element/Abstact.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa elementu formularza
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
	 * Znacznik wymagania
	 * @var string
	 */
	protected $_requiredAsterisk = '*';

	/**
	 * Postfix labelki
	 * @var string
	 */
	protected $_labelPostfix = ':';

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
		'fetchErrors', 'fetchLabel', 'fetchField', 'fetchDescription'
	);

	/**
	 * Renderer pola
	 * @return string
	 */
	public function __toString() {
		$this->preRender();
		$html = $this->fetchBegin();
		foreach ($this->_renderingOrder as $method) {
			if (!method_exists($this, $method)) {
				continue;
			}
			$html .= $this->{$method}();
		}
		$html .= $this->fetchEnd();
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
		if (!isset($this->_options['markRequired'])) {
			$this->_options['markRequired'] = true;
		}
		if (isset($this->_options['labelPostfix'])) {
			$this->_labelPostfix = $this->_options['labelPostfix'];
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
	 * Ustawia form macierzysty
	 * @param Mmi_Form $form
	 */
	public function setForm(Mmi_Form $form) {
		$this->_form = $form;
	}

	/**
	 * Pobranie formularza macierzystego
	 * @return Mmi_Form
	 */
	public function getForm() {
		return $this->_form;
	}

	/**
	 *
	 * @param array $renderingOrder
	 */
	public function setRenderingOrder(array $renderingOrder = array()) {
		foreach ($renderingOrder as $method) {
			if (!method_exists($this, $method)) {
				throw new Exception('Unknown rendering method');
			}
		}
		$this->_renderingOrder = $renderingOrder;
	}

	/**
	 * Ustawia postfix labela
	 * @param string $labelPostfix
	 * @return Mmi_Form_Element_Abstract
	 */
	public function setLabelPostfix($labelPostfix) {
		$this->_labelPostfix = $labelPostfix;
		$this->__set('labelPostfix', $labelPostfix);
		return $this;
	}

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {}

	/**
	 * Funkcja użytkownika, jest wykonywana przed renderingiem
	 */
	public function preRender() {}

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
	 * Magicznie usuwa opcję o danym kluczu
	 * @param string $key klucz
	 */
	public final function __unset($key) {
		unset($this->_options[$key]);
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
	 * Ustawia wartość pola formularza
	 * @param mixed $value wartość
	 */
	public final function setValue($value) {
		$this->_options['value'] = $value;
	}
	
	/**
	 * Ustawia nazwę pola formularza
	 * @param mixed $name wartość
	 */
	public final function setName($name) {
		$this->_options['name'] = $name;
	}

	/**
	 * Wyłącza translator
	 * @param boolean $disable
	 */
	public final function setDisableTranslator($disable = true) {
		$this->_translatorEnabled = !$disable;
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
	public final function getTranslator() {
		return Mmi_Registry::get('Mmi_Translate');
	}

	/**
	 * Zwraca czy pole jest ignorowane
	 * @return boolean
	 */
	public final function isIgnored() {
		return (isset($this->_options['ignore']) && $this->_options['ignore']) ? true : false;
	}

	/**
	 * Waliduje pole i zwraca czy wpis w polu jest poprawny
	 * @return boolean
	 */
	public final function isValid() {
		$result = true;
		if ($this->_options['required'] || $this->value != '') {
			if (!is_array($this->getValidators())) {
				return true;
			}
			foreach($this->getValidators() as $validator) {
				$options = array();
				$message = null;
				if (is_array($validator)) {
					$options = isset($validator['options']) ? $validator['options'] : array();
					$message = isset($validator['message']) ? $validator['message'] : null;
					$validator = $validator['validator'];
				}
				$validator = $this->_getValidator($validator);

				$validator->setOptions($options);
				if (!$validator->isValid($this->value)) {
					$result = false;
					$this->_errors[] = ($message !== null) ? $message : $validator->getError();
				}
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
	 * @param type $error
	 */
	public final function addClass($className) {
		$this->_options['class'] = trim($this->_options['class'] .= ' ' . $className);
		return $this;
	}

	/**
	 * Dodaje filtr
	 * @param string $name nazwa
	 * @return Mmi_Form_Element_Abstract
	 */
	public final function addFilter($name) {
		if (!isset($this->_options['filters']) || !is_array($this->_options['filters'])) {
			$this->_options['filters'] = array();
		}
		$this->_options['filters'][] = $name;
		return $this;
	}

	/**
	 * Filtruje daną wartość za pomocą filtrów pola
	 * @param mixed $value wartość
	 * @return mixed wynik filtracji
	 */
	public final function applyFilters($value) {
		if (!isset($this->_options['filters']) || !is_array($this->_options['filters'])) {
			return $value;
		}
		foreach ($this->_options['filters'] as $filter) {
			$params = explode(':', $filter);
			$filterName = $params[0];
			array_shift($params);
			$filter = $this->_getFilter($filterName);
			if (!empty($params)) {
				$filter->setOptions($params);
			}
			$value = $filter->filter($value);
		}
		return $value;
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
		unset($options['decorators']);
		unset($options['description']);
		unset($options['filters']);
		unset($options['ignore']);
		unset($options['label']);
		unset($options['labelPostfix']);
		unset($options['markRequired']);
		unset($options['multiOptions']);
		unset($options['options']);
		unset($options['required']);
		unset($options['translatorDisabled']);
		unset($options['validators']);
		unset($options['classDisabled']);
		$html = '';
		foreach ($options as $key => $value) {
			$html .= $key . '="' . str_replace('"', '&quot;', $value) . '" ';
		}
		return $html;
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
			$required = '<span class="required">' . $this->_requiredAsterisk . '</span>';
		} else {
			$requiredClass = '';
			$required = '';
		}
		if ($this->_translatorEnabled) {
			$label = $this->getTranslator()->_($this->_options['label']);
		} else {
			$label = $this->_options['label'];
		}
		return '<label' . $forHtml . $requiredClass . '>' . $label . $this->_labelPostfix . $required . '</label>';
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
		if ($this->_translatorEnabled) {
			$description = $this->getTranslator()->_($this->_options['description']);
		} else {
			$description = $this->_options['description'];
		}
		return '<div'. $id . ' class="description">' . $description . '</div>';
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
			$html .= '<ul>';
			foreach($this->_errors as $error) {
				if ($this->_translatorEnabled) {
					$err = $this->getTranslator()->_($error);
				} else {
					$err = $error;
				}
				$html .= '<li>' . $err . '</li>';
			}
			$html .= '</ul>';
		}
		$html .= '<div class="clear"></div></div>';
		return $html;
	}

}