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
 * Mmi/Validate/Integer.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji za pomocą wyrażenia regularnego
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Regex extends ValidateAbstract {

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
	const ERROROUS = 'Błędne wyrażenie regularne';

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
