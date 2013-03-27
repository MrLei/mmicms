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
 * Mmi/Filter/Replace.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Filtr zamieniający znaki
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Filter_Replace extends Mmi_Filter_Abstract {

	public function filter($value) {
		$search = isset($this->_options[0]) ? $this->_options[0] : '';
		$replace = isset($this->_options[1]) ? $this->_options[1] : '';
		return str_replace($search, $replace, $value);
	}

}
