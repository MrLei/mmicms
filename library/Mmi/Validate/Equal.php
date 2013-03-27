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
 * Mmi/Validate/Equal.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Ernest Wojciuk <ernest@wojciuk.com>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji porównianie wartości
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Equal extends Mmi_Validate_Abstract {

    /**
     * Treść wiadomości
     */
    const INVALID = 'Wprowadzona wartość nie jest poprawna';

    const CHECKBOX_INVALID = 'Zaznaczenie jest wymagane';

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