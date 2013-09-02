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
 * Mmi/Validate/Antirobot.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa poprawności kodu zabezpieczenia przed robotami
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Antirobot extends Mmi_Validate_Abstract {
	
	/**
     * Komunikat błędnego kodu zabezpieczającego
     */
	const INVALID = 'Kod zabezpieczenia niepoprawny';

	/**
	 * Waliduje poprawność captcha
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		$this->_error(self::INVALID);
		return (('js-' . self::generateCrc() . '-js') == $value);
	}
	
	/**
	 * Generowanie unikalnego CRC na dany dzień
	 * @return integer
	 */
	public static function generateCrc() {
		return crc32(date('Y-m-d') . 'antirobot-crc');
	}
	
}