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
 * Mmi/Auth/Model/Interface.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Interface modelu autoryzacji
 * @category   Mmi
 * @package    Mmi_Auth
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
interface Mmi_Auth_Model_Interface {

	/**
	 * Autoryzacja z podaniem identyfikatora i hasła
	 * @param string $identity identyfikator
	 * @param string $credential hasło
	 */
	public static function authenticate($identity, $credential);

	/**
	 * Zaufana autoryzacja z podaniem identyfikatora
	 * @param string $identity identyfikator
	 */
	public static function idAuthenticate($identity);
	
	/**
	 * Niszczy autoryzację
	 */
	public static function deauthenticate();
	
}
	