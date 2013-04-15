<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/View/Helper/ThumbId.php
 * @category MmiCms
 * @package MmiCms_View
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Generator miniatur po id
 * @category MmiCms
 * @package MmiCms_View
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_View_Helper_ThumbId {

	/**
	 * Metoda główna, generuje miniaturę
	 * @param int $id identyfikator pliku
	 * @param string $type skala
	 * @param string $value
	 * @return string
	 */
	public function thumbId($id, $type = null, $value = null) {
		$file = new Cms_Model_File_Record($id);
		return $file->getUrl($type, $value);
	}

}
