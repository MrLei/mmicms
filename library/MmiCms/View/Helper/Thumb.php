<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * MmiCms/View/Helper/Thumb.php
 * @category   MmiCms
 * @package    MmiCms\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Generator miniatur
 * @category   MmiCms
 * @package    MmiCms\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms\View\Helper;

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
		if ($url) {
			return $this->view->mediaServer . $url;
		}
		return null;
	}

}
