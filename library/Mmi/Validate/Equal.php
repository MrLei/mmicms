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
 * Mmi/Validate/Equal.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Ernest Wojciuk <ernest@wojciuk.com>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji porównianie wartości
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Equal extends ValidateAbstract {

    /**
     * Treść wiadomości
     */
    const INVALID = 'Wprowadzona wartość nie jest poprawna';
	
	/**
     * Komunikat zaznaczenia pola
     */
    const CHECKBOX_INVALID = 'Zaznaczenie jest wymagane';
	
	/**
	 * Walidacja porówniania wartości
	 * @param mixed $value wartość
	 * @return boolean
	 */
    public function isValid($value) {
        if (!isset($this->_options['value']) || $this->_options['value'] != $value) {
            if(isset($this->_options['type']) && $this->_options['type'] == 'checkbox') {
                $this->_error(self::CHECKBOX_INVALID);
            } else {
                $this->_error(self::INVALID);
            }
            return false;
        }
        return true;
    }
}