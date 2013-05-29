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
 * MmiCns/View/Helper/Translate.php
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
 * @see Mmi_Registry
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_View_Helper_Translate extends Mmi_View_Helper_Abstract {

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
	public function _() {
		$translate = Mmi_Registry::get('Mmi_Translate');
		$args = func_get_args();
		return call_user_func_array(array($translate, '_'), $args);
	}
}
