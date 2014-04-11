<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontak na adres office@hqsoft.pl
 *
 * application/modules/admin/models/ErrorLog.php
 * @category   admin
 * @package    model
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 *
 * @category   admin
 * @package    model
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Admin_Model_ErrorLog {

	public function getContent() {
		$logFile = TMP_PATH . '/log/error.execution.log';
		return nl2br(file_get_contents($logFile, 0, NULL, filesize($logFile) - 32000));
	}

}
