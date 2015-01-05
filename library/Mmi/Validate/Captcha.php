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
 * Mmi/Validate/Captcha.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa poprawności captcha
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Validate_Captcha extends Mmi_Validate_Abstract {

	const INVALID = 'Przepisany kod jest niepoprawny';

	/**
	 * Waliduje poprawność captcha
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		$this->_error(self::INVALID);
		$session = new Mmi_Session_Namespace('Mmi_Form');
		$name = 'captcha_' . $this->_options['name'];
		return ($session->$name == strtoupper($value));
	}
}