<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Form extends \Mmi\Controller\Action {

	public function validateAction() {
		$this->view->setLayoutDisabled();
		$this->getResponse()->setTypePlain();
		if (!isset($_POST['ctrl']) || !isset($_POST['field'])) {
			return '';
		}
		$options = \Mmi\Lib::unhashTable($_POST['ctrl']);
		$field = $_POST['field'];
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$_POST = array();
		if (!isset($options['class'])) {
			return '';
		}
		if (!isset($options['options'])) {
			return '';
		}
		$class = $options['class'];
		$formOptions = $options['options'];
		$formOptions['ajax'] = true;
		$id = isset($this->getRequest()->id) ? intval($this->getRequest()->id) : null;
		$form = new $class($id, $formOptions);
		$element = $form->getElement($field);
		if (!$element instanceof \Mmi\Form\Element\ElementAbstract) {
			return '';
		}
		if ($element->noAjax) {
			return '';
		}
		$element->value = $element->applyFilters($value);
		if (!$element->isValid() && $element->hasErrors()) {
			$this->view->errors = $element->getErrors();
		} else {
			return '';
		}
	}

}
