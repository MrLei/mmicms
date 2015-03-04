<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form;

abstract class Base extends Renderer {

	/**
	 * Elementy formularza
	 * @var array
	 */
	protected $_elements = array();

	/**
	 * Ustawia akcję formularza
	 * @param string $value akcja
	 */
	public function setAction($value) {
		$this->setOption('action', $value);
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
