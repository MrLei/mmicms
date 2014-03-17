<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Config.php
 * @category   MmiCms
 * @package    MmiCms_Config
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   MmiCms
 * @package    MmiCms_Config
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class MmiCms_Config extends Mmi_Config {

	/**
	 * Podstawowa konfiguracja CMS
	 * @var MmiCms_Media_Config
	 */
	public $media;

	/**
	 * Konfiguracja sesji
	 * @var Mmi_Session_Config
	 */
	public $session;

	/**
	 * Konfiguracji bazy danych
	 * @var Mmi_Db_Config
	 */
	public $db;

	public function __construct() {

		parent::__construct();

		$this->media = new MmiCms_Media_Config();
		$this->session = new Mmi_Session_Config();
		$this->db = new Mmi_Db_Config();
	}

}
