<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
