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
 * @package    MmiCms\Config
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   MmiCms
 * @package    MmiCms\Config
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms;

abstract class Config extends \Mmi\Config {

	/**
	 * Podstawowa konfiguracja CMS
	 * @var MmiCms\Media\Config
	 */
	public $media;

	/**
	 * Konfiguracja sesji
	 * @var \Mmi\Session\Config
	 */
	public $session;

	/*
	 * Nawigacja
	 * @var \Mmi\Navigation\Config
	 */
	public $navigation;

	/**
	 * Konfiguracji bazy danych
	 * @var \Mmi\Db\Config
	 */
	public $db;

	public function __construct() {

		parent::__construct();

		$this->media = new \MmiCms\Media\Config();
		$this->navigation = new \Mmi\Navigation\Config();
		$this->session = new \Mmi\Session\Config();
		$this->db = new \Mmi\Db\Config();
	}

}
