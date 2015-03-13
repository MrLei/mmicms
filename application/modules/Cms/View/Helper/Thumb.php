<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\View\Helper;

class Thumb extends \Mmi\View\Helper\HelperAbstract {

	/**
	 * Metoda główna, generuje miniaturę
	 * @param \Cms\Model\File\Record $file instancja pliku
	 * @param string $type skala
	 * @param string $value
	 * @return string
	 */
	public function thumb(\Cms\Model\File\Record $file, $type = null, $value = null) {
		$url = $file->getUrl($type, $value);
		return $url;
	}

}
