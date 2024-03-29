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
 * Mmi/Controller/Environment.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Obiekt środowiska uruchomienia kontrolera
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Environment {

	/**
	 * Do ustawienia przez administratora aplikacji, dla stron wielojęzycznych
	 * @var string
	 */
	public $applicationLanguage;

	/**
	 * Nazwa użytkownika Basic-Auth
	 * @var string
	 */
	public $authUser;

	/**
	 * Hasło użytkownika Basic-Auth
	 * @var string
	 */
	public $authPassword;

	/**
	 *
	 * @var string
	 */
	public $documentRoot;

	/**
	 * Nagłówek Http-Accept-Language
	 * @var string
	 */
	public $httpAcceptLanguage;

	/**
	 * Nagłówek Http-Accept-Encoding
	 * @var string
	 */
	public $httpAcceptEncoding;

	/**
	 * Host
	 * @var string
	 */
	public $httpHost;

	/**
	 *
	 * @var string
	 */
	public $httpOrigin;

	/**
	 * Referer
	 * @var string
	 */
	public $httpReferer;

	/**
	 * Czy połączenie po HTTPS
	 * @var bool
	 */
	public $httpSecure;

	/**
	 * Przeglądarka użytkownika
	 * @var string
	 */
	public $httpUserAgent;

	/**
	 * IP klienta
	 * @var string
	 */
	public $remoteAddress;

	/**
	 * Port klienta
	 * @var int
	 */
	public $remotePort;

	/**
	 * Adres uri
	 * @var string
	 */
	public $requestUri;

	/**
	 * Nazwa wykonywanego skryptu
	 * @var string
	 */
	public $scriptFilename;

	/**
	 * IP serwera
	 * @var string
	 */
	public $serverAddress;

	/**
	 * Port serwera
	 * @var int
	 */
	public $serverPort;

	/**
	 * Oprogramowanie serwera
	 * @var string
	 */
	public $serverSoftware;

	public function __construct() {

		$this->applicationLanguage = filter_input(INPUT_SERVER, 'APPLICATION_LANGUAGE');

		$this->authUser = isset($_SERVER['PHP_AUTH_USER']) ? filter_var($_SERVER['PHP_AUTH_USER']) : null;
		$this->authPassword = isset($_SERVER['PHP_AUTH_PW']) ? filter_var($_SERVER['PHP_AUTH_PW']) : null;
		$this->documentRoot = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_SPECIAL_CHARS);

		$this->httpAcceptLanguage = filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->httpAcceptEncoding = filter_input(INPUT_SERVER, 'HTTP_ACCEPT_ENCODING', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->httpHost = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->httpOrigin = filter_input(INPUT_SERVER, 'HTTP_ORIGIN', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->httpReferer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->httpSecure = (filter_input(INPUT_SERVER, 'HTTPS') == 'on') ? true : false;
		$this->httpUserAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);

		$this->remoteAddress = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', FILTER_SANITIZE_SPECIAL_CHARS);
		if ($this->remoteAddress === null) {
			$this->remoteAddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_SPECIAL_CHARS);
		}
		if ($this->remoteAddress === null) {
			$this->remoteAddress = '0.0.0.0';
		}
		$this->remotePort = filter_input(INPUT_SERVER, 'REMOTE_PORT', FILTER_SANITIZE_NUMBER_INT);

		$this->requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_SPECIAL_CHARS);
		if ($this->requestUri === null) {
			$this->remoteUri = '/';
		}

		$this->scriptFilename = filter_input(INPUT_SERVER, 'SCRIPT_FILENAME', FILTER_SANITIZE_SPECIAL_CHARS);

		$this->serverAddress = filter_input(INPUT_SERVER, 'SERVER_ADDR', FILTER_SANITIZE_SPECIAL_CHARS);
		$this->serverPort = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
		$this->serverSoftware = filter_input(INPUT_SERVER, 'SERVER_SOFTWARE', FILTER_SANITIZE_SPECIAL_CHARS);
		if ($this->serverPort == 443) {
			$this->httpSecure = true;
		}
	}

}
