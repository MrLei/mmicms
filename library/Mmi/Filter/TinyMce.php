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
 * Mmi/Filter/TinyMce.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa filtracji zmiennych tak by były poprawnie przekazywane przez GET
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Filter_TinyMce extends Mmi_Filter_Abstract {

	/**
	 * Filtruje zmienne tak by były poprawnie przekazywane przez GET
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		return strip_tags($value, '<img><em><b><strong><u><p><a><br><ul><ol><hr><table><th><tbody><thead><tr><td><li><span><div><h1><h2><h3><h4><h5><h6><sup><sub><iframe><code>');
	}

}
