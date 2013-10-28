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
 * Mmi/View/Helper/File.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper ścieżki do plików w skórze
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_File extends Mmi_View_Helper_Abstract {

	/**
	 * Zwraca ścieżkę do pliku leżącego w skórze
	 * @param string $name nazwa pliku
	 * @return string
	 */
	public function file($name) {
		if (isset($this->view->baseSkin) && isset($this->view->baseModule) && file_exists(PUBLIC_PATH . '/' . $this->view->baseSkin . '/' . $this->view->baseModule . '/images/' . $name)) {
			return $this->view->baseUrl . '/' . $this->view->baseSkin . '/' . $this->view->baseModule . '/images/' . $name;
		}
		if (isset($this->view->baseModule) && file_exists(PUBLIC_PATH . '/default/' . $this->view->baseModule . '/images/' . $name)) {
			return $this->view->baseUrl . '/default/' . $this->view->baseModule . '/images/' . $name;
		}
		if (isset($this->view->baseSkin) && file_exists(PUBLIC_PATH . '/' . $this->view->baseSkin . '/default/images/' . $name)) {
			return $this->view->baseUrl . '/' . $this->view->baseSkin . '/default/images/' . $name;
		}
		if (file_exists(PUBLIC_PATH . '/' . $this->view->skin . '/' . $this->view->module . '/images/' . $name)) {
			return $this->view->baseUrl . '/' . $this->view->skin . '/' . $this->view->module . '/images/' . $name;
		}
		if (file_exists(PUBLIC_PATH . '/' . $this->view->skin . '/default/images/' . $name)) {
			return $this->view->baseUrl . '/' . $this->view->skin . '/default/images/' . $name;
		}
		if (file_exists(PUBLIC_PATH . '/default/' . $this->view->module . '/images/' . $name)) {
			return $this->view->baseUrl . '/default/' . $this->view->module . '/images/' . $name;
		}
		if (file_exists(PUBLIC_PATH . '/default/default/images/' . $name)) {
			return $this->view->baseUrl . '/default/default/images/' . $name;
		}
		return null;
	}
}