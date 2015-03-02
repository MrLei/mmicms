<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class Escape extends HelperAbstract {

	/**
	 * Usuwa tagi z ciągu znaków
	 * @see \Mmi\Filter\Escape
	 * @param string $input ciąg wejściowy
	 * @return string
	 */
	public function escape($input) {
		$escape = new \Mmi\Filter\Escape();
		return $escape->filter($input);
	}

}
