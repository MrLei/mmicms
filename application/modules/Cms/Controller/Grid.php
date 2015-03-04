<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Grid extends \Mmi\Controller\Action {

	public function init() {
		$this->view->setLayoutDisabled();
		$this->getResponse()->setTypePlain();
	}

	public function filterAction() {
		if (!$this->getPost()->ctrl || !$this->getPost()->field) {
			return;
		}
		$options = \Mmi\Lib::unhashTable($this->getPost()->ctrl);
		$field = $this->getPost()->field;
		$value = $this->getPost()->value;
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class();
		if ($field == 'counter') {
			$options['page'] = $value;
		} elseif ($field == 'setRowsPerPage') {
			$options['page'] = '1';
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
		if (!$this->getPost()->ctrl || !$this->getPost()->field) {
			return;
		}
		$options = \Mmi\Lib::unhashTable($this->getPost()->ctrl);
		$field = $this->getPost()->field;
		$value = $this->getPost()->value ? $this->getPost()->value : '';
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class(); /* @var $grid \Mmi\Grid */
		if ($value) {
			if ($value == 'DESC') {
				$options['order'][$field] = 'DESC';
			} else {
				$options['order'][$field] = 'ASC';
			}
		} elseif (isset($options['order'][$field])) {
			unset($options['order'][$field]);
		}
		$grid->setOptions($options);
		$this->view->grid = $grid;
	}

	public function fieldAction() {
		if (!$this->getPost()->ctrl || !$this->getPost()->field || !$this->getPost()->identifier) {
			return;
		}
		$options = \Mmi\Lib::unhashTable($this->getPost()->ctrl);
		$field = $this->getPost()->field;
		$identifier = $this->getPost()->field;
		$value = isset($this->getPost()->value) ? $this->getPost()->value : '';
		if (!$options) {
			return;
		}
		$class = $options['className'];
		$grid = new $class();
		$record = $grid->getQuery()->findPk($identifier);
		if ($record === null) {
			return;
		}
		$record->$field = $value;
		$record->save();
	}

}
