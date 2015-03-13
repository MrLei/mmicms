<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

abstract class ElementAbstract extends Base\Element {

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
	 * @var \Mmi\Form
	 */
	protected $_form = null;

	/**
	 * Konstruktor, ustawia nazwę pola i opcje
	 * @param string $name nazwa
	 * @param array $options opcje
	 */
	public function __construct($name) {
		$this->setName($name)
			->setRequired(false)
			->setRequiredAsterisk('*')
			->setMarkRequired()
			->setLabelPostfix(':')
			->setIgnore(false)
			->setDisableTranslator()
			->init();
	}

	/**
	 * Ustawia form macierzysty
	 * @param \Mmi\Form $form
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public final function setForm(\Mmi\Form $form) {
		$this->_form = $form;
		return $this;
	}

	/**
	 * Pobranie formularza macierzystego
	 * @return \Mmi\Form
	 */
	public final function getForm() {
		return $this->_form;
	}

	/**
	 * Wyłącza translator
	 * @param boolean $disable
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public final function setDisableTranslator($disable = true) {
		$this->_translatorEnabled = !$disable;
		return $this;
	}

	/**
	 * Pobiera typ pola
	 * @return string
	 */
	public final function getType() {
		return get_class($this);
	}

	/**
	 * Pobiera translator
	 * @return \Mmi\Translate
	 */
	public final function getTranslate() {
		$translate = \Mmi\Controller\Front::getInstance()->getView()->getTranslate();
		return (null === $translate) ? new \Mmi\Translate() : $translate;
	}

	/**
	 * Waliduje pole
	 * @return boolean
	 */
	public final function isValid() {
		$result = true;
		//waliduje poprawnie jeśli niewymagane, ale tylko gdy niepuste
		if (!($this->isRequired() || $this->getValue() != '')) {
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
			if (!$v->isValid($this->getValue())) {
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
	 * @return \Mmi\Form\Element\ElementAbstract
	 */
	public final function addError($error) {
		$this->_errors[] = $error;
		return $this;
	}

	/**
	 * Pobiera obiekt filtra
	 * @param string $name nazwa filtra
	 * @return \Mmi\Filter\Interface
	 */
	protected final function _getFilter($name) {
		$name = ucfirst($name);
		$structure = \Mmi\Controller\Front::getInstance()->getStructure('library');
		foreach ($structure as $libName => $lib) {
			if (isset($lib['Filter'][$name])) {
				$className = $libName . '\\Filter\\' . $name;
			}
		}
		if (!isset($className)) {
			throw new\Exception('Unknown filter: ' . $name);
		}
		return new $className();
	}

	/**
	 * Pobiera nazwę walidatora
	 * @param string $name nazwa walidatora
	 * @return \Mmi\Validate\ValidateAbstract
	 */
	protected final function _getValidator($name) {
		$name = ucfirst($name);
		$structure = \Mmi\Controller\Front::getInstance()->getStructure('library');
		foreach ($structure as $libName => $lib) {
			if (isset($lib['Validate'][$name])) {
				$className = $libName . '\\Validate\\' . $name;
			}
		}
		if (!isset($className)) {
			throw new\Exception('Unknown validator: ' . $name);
		}
		return new $className();
	}

}
