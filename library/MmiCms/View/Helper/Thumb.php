<?php
/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/View/Helper/Thumb.php
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Generator miniatur
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_View_Helper_Thumb extends Mmi_View_Helper_Abstract {

	/**
	 * Metoda główna, generuje miniaturę
	 * @param Cms_Model_File_Record $file instancja pliku
	 * @param string $type skala
	 * @param string $value
	 * @return string
	 */
	public function thumb(Cms_Model_File_Record $file, $type = null, $value = null) {
		$url = $file->getUrl($type, $value);
		if ($url) {
			return $this->view->mediaServer . $url;
		}
		return null;
	}

}
