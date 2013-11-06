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
 * Mmi/Controller/Request.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa żądania
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Request {

	/**
	 * Zmienne żądania
	 * @var array
	 */
	private $_data = array();

	/**
	 * Konstruktor, pozwala podać zmienne requestu
	 * @param array $data zmienne requestu
	 */
	public function __construct(array $data = array()) {
		$this->setParams($data);
	}

	/**
	 * Magiczne pobranie zmiennej żądania
	 * @param string $key klucz
	 * @return string
	 */
	public function __get($key) {
		return $this->getParam($key);
	}

	/**
	 * Magiczne sprawczenie istnienia pola
	 * @param string $key klucz
	 * @return bool
	 */
	public function __isset($key) {
		return isset($this->_data[$key]);
	}

	/**
	 * Magicznie usuwa pole
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($this->_data[$key]);
	}

	/**
	 * Magiczne ustawienie zmiennej żądania
	 * @param string $key klucz
	 * @param string $value wartość
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}

	/**
	 * Zwraca zmienne żądania w formie tabeli
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}

	/**
	 * Pobiera zmienną żądania
	 * @param string $key klucz
	 * @return string
	 */
	public function getParam($key) {
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	/**
	 * Ustawia zmienną żądania
	 * @param string $key klucz
	 * @param string $value wartość
	 */
	public function setParam($key, $value = null) {
		$this->_data[$key] = $value;
	}
	
	/**
	 * Ustawia wszystkie zmienne żądania
	 * @param array $data parametry
	 * @param bool $reset usuwa wcześniej istniejące parametry
	 */
	public function setParams(array $data = array(), $reset = false) {
		if ($reset) {
			$this->_data = array();
		}
		foreach ($data as $key => $value) {
			$this->_data[$key] = $value;
		}
	}
	
	/**
	 * Pobiera wszystkie zmienne w postaci tabeli
	 * @return array
	 */
	public function getParams() {
		return $this->_data;
	}

	/**
	 * Określa czy w żądaniu zawarty był POST
	 * @return boolean
	 */
	public function isPost() {
		return isset($_POST) && !empty($_POST);
	}

	/**
	 * Zwraca zmienne POST w postaci tabeli
	 * @return array
	 */
	public function getPost() {
		return $_POST;
	}
	
	/**
	 * Pobiera informacje o zuploadowanych plikach FILES
	 * @return array
	 */
	public function getFiles() {
		$files = array();
		foreach ($_FILES as $fieldName => $fieldFiles) {
			//pojedynczy upload w danym polu
			if (!is_array($fieldFiles['name'])) {
				if (!isset($fieldFiles['tmp_name']) || $fieldFiles['tmp_name'] == '') {
					continue;
				}
				$fieldFiles['type'] = Mmi_Lib::mimeType($fieldFiles['tmp_name']);
				$files[$fieldName] = $fieldFiles;
				continue;
			}
			//upload wielokrotny html >= 5
			for ($i = 0, $count = count($fieldFiles['name']); $i< $count; $i++) {
				if (!isset($files[$fieldName])) {
					$files[$fieldName] = array();
				}
				$files[$fieldName][$i] = array(
					'name' => $fieldFiles['name'][$i],
					'type' => Mmi_Lib::mimeType($fieldFiles['tmp_name'][$i]),
					'tmp_name' => $fieldFiles['tmp_name'][$i],
					'error' => $fieldFiles['error'][$i],
					'size' => $fieldFiles['size'][$i]
				);
			}
		}
		return $files;
	}
	
	/**
	 * Zwraca referer, lub stronę główną jeśli brak
	 * @return string
	 */
	public function getReferer() {
		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : Mmi_View::getInstance()->url();
	}

	/**
	 * Zwraca parametry w postaci tabeli, poza modułem, kontrolerem i akcją
	 * @return array
	 */
	public function getUserParams() {
		$data = $this->_data;
		unset($data['module']);
		unset($data['controller']);
		unset($data['action']);
		unset($data['lang']);
		unset($data['skin']);
		return $data;
	}

	/**
	 * Zwraca moduł
	 * @return string
	 */
	public function getModuleName() {
		return $this->getParam('module');
	}

	/**
	 * Zwraca kontroler
	 * @return string
	 */
	public function getControllerName() {
		return $this->getParam('controller');
	}

	/**
	 * Zwraca akcję
	 * @return string
	 */
	public function getActionName() {
		return $this->getParam('action');
	}

	/**
	 * Ustawia moduł
	 */
	public function setModuleName($value) {
		$this->setParam('module', $value);
	}

	/**
	 * Ustawia kontroler
	 */
	public function setControllerName($value) {
		$this->setParam('controller', $value);
	}

	/**
	 * Ustawia akcję
	 */
	public function setActionName($value) {
		$this->setParam('action', $value);
	}

	/**
	 * Pobiera ścieżkę bazową
	 */
	public function getBaseUrl() {
		return Mmi_Controller_Router::getInstance()->getBaseUrl();
	}

}
