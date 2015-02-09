<?php
/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/View/Helper/Translate.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Helper translatora, używa zmiennej 'Mmi_Translate' z rejestru
 * @see Mmi_Translate
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_View_Helper_Translate extends Mmi_View_Helper_Abstract {

	/**
	 * Metoda główna, zwraca swoją instancję
	 * @return Mmi_View_Helper_Translate
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
