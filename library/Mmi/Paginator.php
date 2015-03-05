<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

class Paginator extends Paginator\Base\Renderer {

	/**
	 * Konstruktor, przyjmuje opcje, ustawia wartości domyślne
	 * @param array $options opcje
	 */
	public function __construct(array $options = array()) {
		$this->setRowsPerPage(10)
			->setShowPages(10)
			->setPreviousLabel('&#171;')
			->setNextLabel('&#187;')
			->setHashHref('')
			->setPageVariable('p')
			->setOptions($options);
	}

}
