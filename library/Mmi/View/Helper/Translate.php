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
 * Mmi/View/Helper/Translate.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper translatora, używa zmiennej 'Mmi_Translate' z rejestru
 * @see Mmi_Translate
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_Translate extends Mmi_View_Helper_Abstract {

	/**
	 * Obiekt translatora
	 * @var Mmi_Translate
	 */
	protected static $_translate;

	/**
	 * Ustawia obiekt translatora
	 * @param Mmi_Translate $_translate
	 * @return Mmi_Translate
	 */
	public static function setTranslate(Mmi_Translate $translate) {
		self::$_translate = $translate;
		return $translate;
	}

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
		if (self::$_translate === null) {
			return $key;
		}
		return self::$_translate->_($key);
	}
}
