<?php

class Cms_Controller_Form extends Mmi_Controller_Action {

	public function validateAction() {
		Mmi_Controller_Front::getInstance()->getView()->setLayoutDisabled();
		if (!isset($_POST['ctrl']) || !isset($_POST['field'])) {
			exit;
		}
		$options = Mmi_Lib::unhashTable($_POST['ctrl']);
		$field = $_POST['field'];
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$_POST = array();
		if (!isset($options['class'])) {
			exit;
		}
		if (!isset($options['options'])) {
			exit;
		}
		$class = $options['class'];
		$formOptions = $options['options'];
		$formOptions['ajax'] = true;
		$id = isset($this->getRequest()->id) ? intval($this->getRequest()->id) : null;
		$form = new $class($id, $formOptions);
		$element = $form->getElement($field);
		if (!$element instanceof Mmi_Form_Element_Abstract) {
			exit;
		}
		if ($element->noAjax) {
			exit;
		}
		$element->value = $element->applyFilters($value);
		if (!$element->isValid() && $element->hasErrors()) {
			$this->view->errors = $element->getErrors();
		} else {
			exit;
		}
	}

}