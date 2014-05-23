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
 * Mmi/Controller/Response.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa odpowiedzi
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Response {
	
	/**
	 * Przechowuje kody HTTP
	 * @var array
	 */
	private $_httpCodes = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		110 => 'Connection Timed Out',
		111 => 'Connection refused',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modifie',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		310 => 'Too many redirects',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
	);
	
	/**
	 * Przechowuje content-type
	 * @var array
	 */
	private $_contentTypes = array(
		'htm' => 'text/html',
		'html' => 'text/html',
		'shtml' => 'text/html',
		'txt' => 'text/plain',
		'css' => 'text/css',
		'xml' => 'text/xml',
		'mml' => 'text/mathml',
		'htc' => 'text/x-component',
		
		'gif' => 'image/gif',
		'png' => 'image/png',
		'jpg' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'tif' => 'image/tiff',
		'tiff' => 'image/tif',
		'ico' => 'image/x-icon',
		'jng' => 'image/x-jng',
		'bmp' => 'image/x-ms-bmp',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',
		
		'js' => 'application/x-javascript',
		'atom' => 'application/atom+xml',
		'json' => 'application/json',
		'ps' => 'application/postscript',
		'rtf' => 'application/rtf',
		'doc' => 'application/msword',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',
		'xhtml' => 'application/xhtml+xml',
		'zip' => 'application/zip',
		'gz' => 'application/gzip',
		
		'bin' => 'application/octet-stream',
		
		'midi' => 'audio/midi',
		'mp3' => 'audio/mpeg',
		'oga' => 'audio/ogg',
		
		'mp4' => 'video/mp4',
		'mpg' => 'video/mpeg',
		'ogv' => 'video/ogg',
		'avi' => 'video/x-msvideo',
		'flv' => 'video/x-flv',
		'mov' => 'video/quicktime',
	);
	
	/**
	 * Przechowuje content
	 * @var string
	 */
	private $_content;
	
	/**
	 * Włączony debugger
	 * @var type 
	 */
	private $_debug = false;
	
	/**
	 * Typ odpowiedzi
	 * @var string
	 */
	private $_type = 'html';
	
	/**
	 * Konstruktor
	 */
	public function __construct() {
		ob_start();
	}
	
	/**
	 * Ustawia debugowanie
	 * @param type $debug
	 */
	public function setDebug($debug = true) {
		$this->_debug = $debug ? true : false;
	}
	
	/**
	 * Ustawia nagłówek
	 * @param string $name nazwa
	 * @param string $value wartość
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setHeader($name, $value = null, $replace = false) {
		if ($value) {
			header($name . ': ' . $value, $replace);
		} else {
			header($name, $replace);
		}
		return $this;
	}

	/**
	 * Ustawia kod odpowiedzi
	 * @param int $code kod
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCode($code, $replace = false) {
		if (array_key_exists($code, $this->_httpCodes)) {
			return $this->setHeader('HTTP/1.1 ' . $code . ' ' . $this->_httpCodes[$code], null, $replace);
		}
		return $this;
	}

	/**
	 * Ustawia kod na 404
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCodeNotFound($replace = false) {
		return $this->setCode(404, $replace);
	}
	
	/**
	 * Ustawia kod na 410
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCodeGone($replace = false) {
		return $this->setCode(410, $replace);
	}

	/**
	 * Ustawia kod na 200
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCodeOk($replace = false) {
		return $this->setCode(200, $replace);
	}
	
	/**
	 * Ustawia kod na 500
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCodeError($replace = false) {
		return $this->setCode(500, $replace);
	}

	/**
	 * Ustawia kod na 401
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setCodeForbidden($replace = false) {
		return $this->setCode(401, $replace);
	}
	
	/**
	 * Ustawia typ kontentu odpowiedzi (content-type
	 * @param string $type nazwa typu np. jpg, gif, html
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setType($type, $replace = false) {
		$type = strtolower($type);
		if (array_key_exists($type, $this->_contentTypes)) {
			$this->_type = $type;
			return $this->setHeader('Content-type', $this->_contentTypes[$type], $replace);
		}
		return $this->setHeader('Content-type', $type, $replace);
	}
	
	/**
	 * Zwraca typ zwrotu
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * Ustawia typ na HTML
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeHtml($replace = false) {
		return $this->setType('html', $replace);
	}
	
	/**
	 * Ustawia typ na JSON
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeJson($replace = false) {
		return $this->setType('json', $replace);
	}
	
	/**
	 * Ustawia typ na JS
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeJs($replace = false) {
		return $this->setType('js', $replace);
	}
	
	/**
	 * Ustawia typ na Plain
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypePlain($replace = false) {
		return $this->setType('txt', $replace);
	}
	
	/**
	 * Ustawia typ na XML
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeXml($replace = false) {
		return $this->setType('xml', $replace);
	}

	/**
	 * Ustawia typ na obraz PNG
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypePng($replace = false) {
		return $this->setType('png', $replace);
	}
	
	/**
	 * Ustawia typ na obraz Jpeg
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeJpeg($replace = false) {
		return $this->setType('jpeg', $replace);
	}
	
	/**
	 * Ustawia typ na Gzip
	 * @param boolean $replace zastąpienie
	 * @return Mmi_Controller_Response
	 */
	public function setTypeGzip($replace = false) {
		return $this->setType('gz', $replace);
	}
	
	/**
	 * Ustawia content do wysyłki
	 * @param string $content
	 * @return Mmi_Controller_Response
	 */
	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}
	
	/**
	 * Pobiera content
	 * @return string
	 */
	public function getContent() {
		return $this->_content;
	}
	
	/**
	 * Dodaje content do istniejącego
	 * @param string $content
	 * @return Mmi_Controller_Response
	 */
	public function appendContent($content) {
		$this->_content .= $content;
		return $this;
	}
	
	/**
	 * Wysyła dane do klienta
	 */
	public function send() {
		if ($this->_debug) {
			//opcjonalne uruchomienie panelu deweloperskiego
			new Mmi_Controller_Response_Debugger();
		}
		echo $this->_content;
		ob_end_flush();
	}
	
}