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
 * Mmi/View.php
 * @category   Mmi
 * @package    Mmi_View
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa widoku
 * @see Mmi_View_Helper
 * @category   Mmi
 * @package    Mmi_View
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 * 
 * @property Exception $_exception wyjątek
 */
class Mmi_View {

	/**
	 * Bieżąca wersja językowa
	 * @var string
	 */
	private $_locale;

	/**
	 * Dane widoku
	 * @var array
	 */
	private $_data = array();

	/**
	 * Tabela z załadowanymi helperami
	 * @var array
	 */
	private $_helpers = array();

	/**
	 * Tabela z załadowanymi filtrami
	 * @var array
	 */
	private $_filters = array();

	/**
	 * Przechowuje dane placeholderów
	 * @var array
	 */
	private $_placeholders = array();

	/**
	 * Wyłączony
	 * @var boolean
	 */
	private $_layoutDisabled = false;

	/**
	 * Obiekt tłumaczeń
	 * @var Mmi_Translate
	 */
	private $_translate;

	/**
	 * Obiekt buforujący
	 * @var Mmi_Cache
	 */
	private $_cache;
	
	/**
	 * Włączone buforowanie
	 * @var boolean
	 */
	private $_alwaysCompile = true;

	/**
	 * Obiekt requestu
	 * @var Mmi_Controller_Request
	 */
	public $request;

	/**
	 * Bazowa ścieżka
	 * @var string
	 */
	public $baseUrl;

	/**
	 * Zabezpieczony konstruktor
	 */
	public function __construct() {

	}

	/**
	 * Magicznie wywołuje metodę na widoku
	 * przekierowuje wywołanie na odpowiedni helper
	 * @param string $name nazwa metody
	 * @param array $params parametry
	 * @return mixed
	 */
	public function __call($name, array $params = array()) {
		$helper = $this->getHelper($name);
		//poprawny helper
		if ($helper instanceof Mmi_View_Helper_Abstract) {
			return call_user_func_array(array($helper, $name), $params);
		}
		return $this->getPlaceholder($name);
	}

	/**
	 * Magicznie pobiera zmienną
	 * @param string $key klucz
	 * @return mixed
	 */
	public function __get($key) {
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	/**
	 * Magicznie ustawia zmienną
	 * @param string $key klucz
	 * @param mixed $value wartość
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}

	/**
	 * Magicznie sprawdza istnienie zmiennej
	 * @param string $key klucz
	 * @return boolean
	 */
	public function __isset($key) {
		return isset($this->_data[$key]);
	}

	/**
	 * Magicznie usuwa zmienną
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($this->_data[$key]);
	}

	/**
	 * Ustawia obiekt request
	 * @param Mmi_Controller_Request $request
	 * @return Mmi_View
	 */
	public function setRequest(Mmi_Controller_Request $request) {
		$this->request = $request;
		$this->module = $request->getModuleName();
		$this->lang = $request->lang;
		$this->skin = $request->skin;
		return $this;
	}

	/**
	 * Ustawia translator
	 * @param Mmi_Translate $translate
	 * @return Mmi_View
	 */
	public function setTranslate(Mmi_Translate $translate) {
		$this->_translate = $translate;
		return $this;
	}

	/**
	 * Ustawia obiekt cache
	 * @param Mmi_Cache $cache
	 * @return Mmi_View
	 */
	public function setCache(Mmi_Cache $cache) {
		$this->_cache = $cache;
		return $this;
	}

	/**
	 * Ustawia opcję zawsze kompiluj szablony
	 * @param boolean $compile
	 * @return Mmi_View
	 */
	public function setAlwaysCompile($compile = true) {
		$this->_alwaysCompile = $compile;
		return $this;
	}

	/**
	 * Ustawia bazowy url
	 * @param string $baseUrl
	 * @return Mmi_View
	 */
	public function setBaseUrl($baseUrl) {
		$this->baseUrl = $baseUrl;
		return $this;
	}

	/**
	 * Zwraca obiekt translatora
	 * @return Mmi_Translate
	 */
	public function getTranslate() {
		return ($this->_translate !== null) ? $this->_translate : new Mmi_Translate();
	}

	/**
	 * Zwraca obiekt cache
	 * @return Mmi_Cache
	 */
	public function getCache() {
		return $this->_cache;
	}

	/**
	 * Pobiera helper na podstawie nazwy z uwzględnieniem ścieżek do helperów
	 * @param string $name nazwa
	 * @return Mmi_View_Helper_Abstract
	 */
	public function getHelper($name) {
		$name = ucfirst($name);
		$structure = Mmi_Controller_Front::getInstance()->getStructure();
		foreach ($structure['library'] as $libName => $lib) {
			if (isset($lib['View']['Helper'][$name])) {
				$className = $libName . '_View_Helper_' . $name;
			}
		}
		if (isset($this->request) && isset($structure['module'][$this->request->module]['View']['Helper'][$name])) {
			$className = ucfirst($this->request->module) . '_View_Helper_' . $name;
		}
		if (!isset($className)) {
			return false;
		}
		if (isset($this->_helpers[$className])) {
			return $this->_helpers[$className];
		}
		$this->_helpers[$className] = new $className();
		return $this->_helpers[$className];
	}

	/**
	 * Pobiera filtr na podstawie nazwy z uwzględnieniem ścieżek do filtrów
	 * @param string $name nazwa
	 * @return Mmi_View_Helper_Abstract
	 */
	public function getFilter($name) {
		$name = ucfirst($name);
		$structure = Mmi_Controller_Front::getInstance()->getStructure();
		foreach ($structure['library'] as $libName => $lib) {
			if (isset($lib['Filter'][$name])) {
				$className = $libName . '_Filter_' . $name;
			}
		}
		if (isset($this->request) && isset($structure['module'][$this->request->module]['Filter'][$name])) {
			$className = ucfirst($this->request->module) . '_Filter_' . $name;
		}
		if (!isset($className)) {
			throw new Exception('Filter not found: ' . $name);
		}
		if (isset($this->_filters[$className])) {
			return $this->_filters[$className];
		}
		$this->_filters[$className] = new $className();
		return $this->_filters[$className];
	}

	/**
	 * Ustawia placeholder
	 * @param string $name nazwa
	 * @param string $content zawartość
	 * @return Mmi_View
	 */
	public function setPlaceholder($name, $content) {
		$this->_placeholders[$name] = $content;
		return $this;
	}

	/**
	 * Pobiera placeholder
	 * @param string $name nazwa
	 * @return string
	 */
	public function getPlaceholder($name) {
		return isset($this->_placeholders[$name]) ? $this->_placeholders[$name] : null;
	}

	/**
	 * Pobiera wszystkie zmienne w postaci tablicy
	 * @return array
	 */
	public function getAllVariables() {
		return $this->_data;
	}

	/**
	 * Renderuje i zwraca wynik wykonania template
	 * @param string $skin skóra
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @param bool $fetch przekaż wynik wywołania w zmiennej
	 */
	public function renderTemplate($skin, $module, $controller, $action) {
		return $this->render($this->_getTemplate($skin, $module, $controller, $action));
	}

	/**
	 * Generowanie kodu PHP z kodu szablonu w locie
	 * @param string $input kod szablonu
	 * @return string kod PHP
	 */
	public function renderDirectly($input) {
		$prev = ob_get_contents();
		ob_clean();
		$hash = md5($input);
		Mmi_Profiler::event('View direct build: ' . $hash);
		if (!$this->_locale && $this->_translate !== null) {
			$this->_locale = $this->_translate->getLocale();
		}
		$compileName = $this->_locale . '_direct_' . $hash . '.php';
		$destFile = TMP_PATH . '/compile/' . $compileName;
		if ($this->_alwaysCompile) {
			file_put_contents($destFile, $this->template($input, $destFile));
			include $destFile;
		} else {
			try {
				include $destFile;
			} catch (Exception $e) {
				file_put_contents($destFile, $this->template($input, $destFile));
				include $destFile;
			}
		}
		$data = ob_get_contents();
		ob_clean();
		echo $prev;
		Mmi_Profiler::event('View direct fetched: ' . $hash);
		return $data;
	}

	/**
	 * Ustawia wyłączenie layoutu
	 * @param boolean $disabled wyłączony
	 * @return Mmi_View
	 */
	public function setLayoutDisabled($disabled = true) {
		$this->_layoutDisabled = ($disabled === true) ? true : false;
		return $this;
	}
	
	/**
	 * Czy layout wyłączony
	 * @return boolean
	 */
	public function isLayoutDisabled() {
		return $this->_layoutDisabled;
	}

	/**
	 * Renderuje layout
	 */
	public function renderLayout($skin, $module, $controller) {
		//renderowanie layoutu
		return $this->render($this->_getLayout($skin, $module, $controller));
	}

	/**
	 * Renderuje szablon z pliku
	 * @param string $fileName nazwa pliku szablonu
	 * @return string zwraca efekt renderowania
	 */
	public function render($fileName) {
		Mmi_Profiler::event('View build: ' . basename($fileName));
		if (!$this->_locale && $this->_translate !== null) {
			$this->_locale = $this->_translate->getLocale();
		}
		$compileName = $this->_locale . '_' . str_replace(array('/','\\'), '_', substr($fileName, strrpos($fileName, '/application') + 13, -4) . '.php');
		$destFile = TMP_PATH . '/compile/' . $compileName;
		if ($this->_alwaysCompile) {
			$input = file_get_contents($fileName);
			file_put_contents($destFile, $this->template($input, $destFile));
			include $destFile;
		} else {
			try {
				include $destFile;
			} catch (Exception $e) {
				$input = file_get_contents($fileName);
				file_put_contents($destFile, $this->template($input, $destFile));
				include $destFile;
			}
		}
		$data = ob_get_contents();
		ob_clean();
		Mmi_Profiler::event('View fetched: ' . $compileName);
		return $data;
	}

	/**
	 * Pobiera dostępny layout
	 * @param string $skin skóra
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @return string
	 * @throws Exception brak layoutów
	 */
	private function _getLayout($skin, $module, $controller) {
		$structure = Mmi_Controller_Front::getInstance()->getStructure();
		//skóra / moduł / kontroler
		if (isset($structure['skin'][$skin][$module][$controller]['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/' . str_replace('-', '/', $controller) . '/layout.tpl';
		}
		//skóra / moduł
		if (isset($structure['skin'][$skin][$module]['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/layout.tpl';
		}
		//default / moduł / kontroler
		if (isset($structure['skin']['default'][$module][$controller]['layout'])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/' . str_replace('-', '/', $controller) .  '/layout.tpl';
		}
		//default / moduł
		if (isset($structure['skin']['default'][$module]['layout'])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/layout.tpl';
		}
		//skóra / default
		if (isset($structure['skin'][$skin]['default']['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/default/scripts/layout.tpl';
		}
		//default / default
		if (isset($structure['skin']['default']['default']['layout'])) {
			return APPLICATION_PATH . '/skins/default/default/scripts/layout.tpl';
		}
		throw new Exception('Layout not found.');
	}

	/**
	 * Pobiera dostępny template
	 * @param string $skin skóra
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @return string
	 * @throws Exception brak templatów
	 */
	private function _getTemplate($skin, $module, $controller, $action) {
		$structure = Mmi_Controller_Front::getInstance()->getStructure();
		//template w skórze
		if (isset($structure['skin'][$skin][$module][$controller][$action])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/' . str_replace('-', '/', $controller) . '/' . $action . '.tpl';
		}
		//template w default
		if (isset($structure['skin']['default'][$module][$controller][$action])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/' . str_replace('-', '/', $controller) . '/' . $action . '.tpl';
		}
		throw new Exception('Template not found.');
	}

}
