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
 * Mmi/Controller/Request.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa żądania
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
	 * Zwraca Content-Type żądania
	 * @return string
	 */
	public function getContentType() {
		return filter_input(INPUT_SERVER, 'CONTENT_TYPE', FILTER_SANITIZE_SPECIAL_CHARS);
	}
	
	/**
	 * Zwraca metodę żądania (np. GET, POST, PUT)
	 * @return string
	 */
	public function getRequestMethod() {
		return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
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
		return $this;
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
		$alnum = new Mmi_Filter_Alnum();
		foreach ($data as $key => $value) {
			//filtrowanie zmiennych systemowych
			if ($key == 'lang' || $key == 'skin' || $key == 'module' || $key == 'controller' || $key == 'action') {
				$value = $alnum->filter($value);
			}
			$this->_data[$key] = $value;
		}
		return $this;
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
		return Mmi_Controller_Front::getInstance()->getEnvironment()->httpReferer;
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
	 * Zwraca parametry w postaci tabeli, poza modułem, kontrolerem i akcją
	 * połączone z parametrami z POST.
	 * @return array
	 */
	public function getUserAndPostParams() {
		$data = $this->getUserParams();
		if ($this->isPost()) {
			$data = array_merge($data, $this->getPost());
		}
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
	 * @param string $value
	 * @return \Mmi_Controller_Request
	 */
	public function setModuleName($value) {
		$this->setParam('module', $value);
		return $this;
	}

	/**
	 * Ustawia kontroler
	 * @param string $value
	 * @return \Mmi_Controller_Request
	 */
	public function setControllerName($value) {
		$this->setParam('controller', $value);
		return $this;
	}

	/**
	 * Ustawia akcję
	 * @param string $value
	 * @return \Mmi_Controller_Request
	 */
	public function setActionName($value) {
		$this->setParam('action', $value);
		return $this;
	}

	/**
	 * Ustawia nazwę skóry
	 * @param string $value
	 * @return \Mmi_Controller_Request
	 */
	public function setSkinName($value) {
		$this->setParam('skin', $value);
		return $this;
	}

}
