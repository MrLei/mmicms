<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Log extends \Cms\Controller\AdminAbstract {

	public function indexAction() {
		$grid = new \Cms\Plugin\LogGrid();
		$this->view->grid = $grid;
	}

	public function errorAction() {
		$logFile = TMP_PATH . '/log/error.execution.log';
		$this->view->data = nl2br(file_get_contents($logFile, 0, NULL, filesize($logFile) - 32000));
	}

}
