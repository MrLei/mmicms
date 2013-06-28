<?php

class Cms_Controller_Grid extends Mmi_Controller_Action {

	public function init() {
		Mmi_View::getInstance()->setLayoutDisabled();
	}

	public function filterAction() {
		if (!isset($_POST['ctrl']) || !isset($_POST['field'])) {
			return;
		}
		$options = Mmi_Lib::unhashTable($_POST['ctrl']);
		$field = isset($_POST['field']) ? $_POST['field'] : null;
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$_POST = array();
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class();
		if ($field == 'counter') {
			$options['page'] = $value;
		} elseif ($field == 'setRowsPerPage') {
			$options['rows'] = $value;
		} else {
			$options['page'] = '1';
			$options['filter'][$field] = $value;
		}
		if ($value == '') {
			unset($options['filter'][$field]);
		}
		$grid->setOptions($options);
		$this->view->grid = $grid;
	}
	
	public function orderAction() {
		if (!isset($_POST['ctrl']) || !isset($_POST['field'])) {
			return;
		}
		$options = Mmi_Lib::unhashTable($_POST['ctrl']);
		$field = $_POST['field'];
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$_POST = array();
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class();
		if ($value) {
			$options['order'][$field] = $value;
		} elseif(isset($options['order'][$field])) {
			unset($options['order'][$field]);
		}
		$grid->setOptions($options);
		$this->view->grid = $grid;
	}

	public function fieldAction() {
		if (!isset($_POST['ctrl']) || !isset($_POST['field']) || !isset($_POST['identifier'])) {
			return;
		}
		$options = Mmi_Lib::unhashTable($_POST['ctrl']);
		$field = $_POST['field'];
		$identifier = $_POST['identifier'];
		$value = isset($_POST['value']) ? $_POST['value'] : '';
		$_POST = array();
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class();
		$dao = $grid->getDaoName();
		$record = $dao::findPk($identifier);
		if ($record === null) {
			return;
		}
		$record->$field = $value;
		$record->save();
	}

}