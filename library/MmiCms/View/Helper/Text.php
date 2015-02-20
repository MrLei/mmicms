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
 * MmiCms/View/Helper/Text.php
 * @category   MmiCms
 * @package    MmiCms\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Generuje tekst statyczny
 * @category   MmiCms
 * @package    MmiCms\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms\View\Helper;

class Text extends \Mmi\View\Helper\HelperAbstract {

	/**
	 * Generuje tekst statyczny
	 * @param string $key klucz
	 * @return string
	 */
	public function text($key) {
		return nl2br(Cms\Model\Text\Dao::textByKeyLang($key, \Mmi\Controller\Front::getInstance()->getView()->request->lang));
	}

}
