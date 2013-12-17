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
 * MmiCms/View/Helper/Text.php
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Generuje tekst statyczny
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_View_Helper_Text extends Mmi_View_Helper_Abstract {

	/**
	 * Generuje tekst statyczny
	 * @param string $key klucz
	 * @return string
	 */
	public function text($key) {
		return nl2br(Cms_Model_Text_Dao::textByKeyLang($key, Mmi_Controller_Front::getInstance()->getView()->request->lang));
	}

}
