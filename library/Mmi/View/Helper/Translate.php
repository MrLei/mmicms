<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class Translate extends HelperAbstract {

	/**
	 * Metoda główna, zwraca swoją instancję
	 * @return \Mmi\View\Helper\Translate
	 */
	public function translate() {
		return $this;
	}

	/**
	 * Tłumaczy wejściowy ciąg znaków
	 * @return string
	 */
	public function _($key) {
		return $this->view->getTranslate()->_($key);
	}

}
