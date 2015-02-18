<?php

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

	public function __construct() {

		parent::__construct();

		$this->router = new Default_Config_Router();
		$this->navigation = new Default_Config_Navigation();

		$this->application->host = 'localhost';
		$this->application->salt = 'salt-should-be-changed';
		$this->application->skin = 'default';
		$this->application->timeZone = 'Europe/Warsaw';
		$this->application->debug = false;
		$this->application->compile = false;
		$this->application->languages = array();
		$this->application->plugins = array('MmiCms_Controller_Plugin');

		$this->media->server = '';

		$this->session->handler = 'files';
		$this->session->path = TMP_PATH . '/session';
		$this->session->name = 'MmiDemo';

		$this->cache->active = true;
		$this->cache->handler = 'file';
		$this->cache->path = TMP_PATH . '/cache';
		$this->cache->lifetime = 300;

		$this->db->driver = 'sqlite';
		$this->db->host = TMP_PATH . '/demo.sqlite';
	}

}
