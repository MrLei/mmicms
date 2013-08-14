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
 * Mmi/Controller/Response.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa odpowiedzi
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Response {

	/**
	 * Ustawia kod odpowiedzi
	 * @param int $code kod
	 */
	public function setCode($code) {
		$name = 'HTTP/1.0 ' . $code;
		switch ($code) {
			case 100:
				$name .= ' Continue';
				break;
			case 101:
				$name .= ' Switching Protocols';
				break;
			case 200:
				$name .= ' Ok';
				break;
			case 301:
				$name .= ' Moved Permanently';
				break;
			case 302:
				$name .= ' Found';
				break;
			case 304:
				$name .= ' Not Modified';
				break;
			case 403:
				$name .= ' Forbidden';
				break;
			case 404:
				$name .= ' Not Found';
				break;
			case 500:
				$name .= ' Internal Server Error';
				break;
		}
		$this->setHeader($name);
	}

	/**
	 * Ustawia nagłówek
	 * @param string $name nazwa
	 * @param string $value wartość
	 * @param boolean $replace czy zmienić
	 */
	public function setHeader($name, $value = null, $replace = false) {
		if ($value) {
			header($name . ': ' . $value, $replace);
		} else {
			header($name, $replace);
		}
	}
}