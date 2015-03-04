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
		$this->getResponse()->setTypePlain();
		if (!$this->getPost()->ctrl || !$this->getPost()->field) {
			return '';
		}
		$options = \Mmi\Lib::unhashTable($this->getPost()->ctrl);
		$field = $this->getPost()->field;
		if (!isset($options['class'])) {
			return '';
		}
		if (!isset($options['options'])) {
			return '';
		}
		$class = $options['class'];
		$formOptions = $options['options'];
		$formOptions['ajax'] = true;
		$form = new $class(null, $formOptions);
		$element = $form->getElement($field);
		if (!$element instanceof \Mmi\Form\Element\ElementAbstract) {
			return '';
		}
		if ($element->noAjax) {
			return '';
		}
		$element->value = $element->applyFilters($this->getPost()->value);
		if (!$element->isValid() && $element->hasErrors()) {
			$this->view->errors = $element->getErrors();
		} else {
			return '';
		}
	}

}
