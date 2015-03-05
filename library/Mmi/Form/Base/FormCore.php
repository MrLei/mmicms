<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Base;

abstract class FormCore extends \Mmi\OptionObject {

	/**
	 * Nazwa klasy
	 * @var string
	 */
	protected $_className;

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
	 * Hash formularza
	 * @var string
	 */
	protected $_hash;

	/**
	 * CTRL pochodzący z POST
	 * @var string
	 */
	protected $_ctrl;

	/**
	 * Referencja do requestu
	 * @var \Mmi\Controller\Request
	 */
	protected $_request;

	/**
	 * Czy włączone zabezpieczenie csrf
	 * @var boolean
	 */
	protected $_secured = false;

	/**
	 * Rezultat walidacji
	 * @var boolean
	 */
	protected $_validationResult;

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
	 * Ustawia akcję formularza
	 * @param string $value akcja
	 */
	public function setAction($value) {
		$this->setOption('action', $value);
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
		$name = $element->getName();
		$this->_elements[$name] = $element;
		$this->_elements[$name]->setForm($this);
		return $element;
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
		return $this->_request->getPost()->__isset($this->_formBaseName . '__ctrl');
	}

	/**
	 * Walidacja formularza
	 * @return boolean
	 */
	public function isValid() {
		if (!$this->isMine()) {
			return false;
		}
		if ($this->_validationResult !== null) {
			return $this->_validationResult;
		}
		$options = \Mmi\Lib::unhashTable($this->_ctrl);
		if ($options['class'] != $this->_className) {
			return ($this->_validationResult = false);
		}
		if ($this->_secured && $options['hash'] != $this->_hash) {
			$this->getElement($this->_formBaseName . '__ctrl')->addError('Formularz został już wysłany');
			return ($this->_validationResult = false);
		}
		$this->_validationResult = true;
		foreach ($this->getElements() as $element) {
			if (!$element->isValid()) {
				$this->_validationResult = false;
			}
		}
		return $this->_validationResult;
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
	 * Konfigurator elementów ustawia id pola na podstawie id macierzystego formularza
	 */
	protected function _configureElements() {
		foreach ($this->getElements() AS $element) {
			$element->setOption('id', $this->_formBaseName . '_' . $element->getOption('name'));
			$element->setOption('class', trim('field ' . $element->getOption('class')));
			//checkboxy dostają zero jeśli brak wartości
			if ($element instanceof \Mmi\Form\Element\Checkbox) {
				$element->setValue($element->getValue() ? $element->getValue() : 0);
				continue;
			}
			//selecty multiple dostają pusty array jeśli brak wartości
			if ($element instanceof \Mmi\Form\Element\Select && $element->getOption('multiple')) {
				$element->setValue($element->getValue() ? $element->getValue() : array());
				continue;
			}
		}
	}

}
