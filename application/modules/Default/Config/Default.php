<?php

/**
 * Klasa konfiguracji aplikacji
 */
class Default_Config_Default extends MmiCms_Config {

	/**
	 * Konfiguracja routera
	 * @var Default_Config_Router
	 */
	public $router;

	/**
	 * Konfiguracja nawigatora
	 * @var Default_Config_Navigation
	 */
	public $navigation;

	/**
	 * Konstruktor inicjujący konfigurację
	 */
	public function __construct() {

		parent::__construct();

		//konfiguracja routera
		$this->router = new Default_Config_Router();
		
		//konfiguracja nawigatora
		$this->navigation = new Default_Config_Navigation();

		//konfiguracja aplikacji
		$this->application->host = 'localhost';
		$this->application->salt = 'salt-should-be-changed';
		$this->application->skin = 'default';
		$this->application->timeZone = 'Europe/Warsaw';
		//debugger aplikacji
		$this->application->debug = false;
		//kompilacja templatów przy każdym odpaleniu danej strony
		$this->application->compile = false;
		$this->application->languages = array();
		$this->application->plugins = array('MmiCms_Controller_Plugin');

		//media serwer ma wpływ na generowanie linków do zasobów
		$this->media->server = '';

		//konfiguracja sesji
		$this->session->handler = 'files';
		$this->session->path = TMP_PATH . '/session';
		$this->session->name = 'MmiDemo';

		//konfiguracja cache
		$this->cache->active = true;
		$this->cache->handler = 'file';
		$this->cache->path = TMP_PATH . '/cache';
		$this->cache->lifetime = 300;

		//konfiguracja bazy danych
		$this->db->driver = 'sqlite';
		$this->db->host = TMP_PATH . '/demo.sqlite';
	}

}
