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
 * Mmi/Validate/Antirobot.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa poprawności kodu zabezpieczenia przed robotami
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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