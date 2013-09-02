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
 * Mmi/Validate/Integer.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji za pomocą wyrażenia regularnego
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Regex extends Mmi_Validate_Abstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Nieprawidłowy typ danych wejściowych';
		
	/**
     * Komunikat - nie pasuje do wzorca
     */
    const NOT_MATCH = 'Wartość nie pasuje do wzorca';
		
	/**
     * Komunikat o błędzie wyrażenia regularnego
     */
    const ERROROUS  = 'Błędne wyrażenie regularne';
	
	/**
	 * Walidacja za pomocą wyrażenia regularnego
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		$pattern = isset($this->_options[0]) ? $this->_options[0] : null;
		//jeśli nie podano wzorca, to przyjmujemy, że pasuje
		if (is_null($pattern)) {
			return true;
		}
        if (!is_string($value) && !is_int($value) && !is_float($value)) {
            $this->_error(self::INVALID);
            return false;
        }
        $status = preg_match($pattern, $value);
        if ($status === false) {
            $this->_error(self::ERROROUS);
            return false;
        }
        if (!$status) {
            $this->_error(self::NOT_MATCH);
            return false;
        }
        return true;
	}
}