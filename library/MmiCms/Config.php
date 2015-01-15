<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * MmiCms/Config.php
 * @category   MmiCms
 * @package    MmiCms_Config
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   MmiCms
 * @package    MmiCms_Config
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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

	/*
	 * Nawigacja
	 * @var Mmi_Navigation_Config
	 */
	public $navigation;

	/**
	 * Konfiguracji bazy danych
	 * @var Mmi_Db_Config
	 */
	public $db;

	public function __construct() {

		parent::__construct();

		$this->media = new MmiCms_Media_Config();
		$this->navigation = new Mmi_Navigation_Config();
		$this->session = new Mmi_Session_Config();
		$this->db = new Mmi_Db_Config();
	}

}
