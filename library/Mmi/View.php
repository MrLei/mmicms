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
 * @package    \Mmi\View
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa widoku
 * @see \Mmi\View\Helper
 * @category   Mmi
 * @package    \Mmi\View
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 * 
 * @property Exception $_exception wyjątek
 */

namespace Mmi;

class View {

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
	 * @var \Mmi\Translate
	 */
	private $_translate;

	/**
	 * Obiekt buforujący
	 * @var \Mmi\Cache
	 */
	private $_cache;
	
	/**
	 * Włączone buforowanie
	 * @var boolean
	 */
	private $_alwaysCompile = true;

	/**
	 * Obiekt requestu
	 * @var \Mmi\Controller\Request
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
		if ($helper instanceof \Mmi\View\Helper\HelperAbstract) {
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
	 * @param \Mmi\Controller\Request $request
	 * @return \Mmi\View
	 */
	public function setRequest(\Mmi\Controller\Request $request) {
		$this->request = $request;
		$this->module = $request->getModuleName();
		$this->lang = $request->lang;
		$this->skin = $request->skin;
		return $this;
	}

	/**
	 * Ustawia translator
	 * @param \Mmi\Translate $translate
	 * @return \Mmi\View
	 */
	public function setTranslate(\Mmi\Translate $translate) {
		$this->_translate = $translate;
		return $this;
	}

	/**
	 * Ustawia obiekt cache
	 * @param \Mmi\Cache $cache
	 * @return \Mmi\View
	 */
	public function setCache(\Mmi\Cache $cache) {
		$this->_cache = $cache;
		return $this;
	}

	/**
	 * Ustawia opcję zawsze kompiluj szablony
	 * @param boolean $compile
	 * @return \Mmi\View
	 */
	public function setAlwaysCompile($compile = true) {
		$this->_alwaysCompile = $compile;
		return $this;
	}

	/**
	 * Ustawia bazowy url
	 * @param string $baseUrl
	 * @return \Mmi\View
	 */
	public function setBaseUrl($baseUrl) {
		$this->baseUrl = $baseUrl;
		return $this;
	}

	/**
	 * Zwraca obiekt translatora
	 * @return \Mmi\Translate
	 */
	public function getTranslate() {
		return ($this->_translate !== null) ? $this->_translate : new \Mmi\Translate();
	}

	/**
	 * Zwraca obiekt cache
	 * @return \Mmi\Cache
	 */
	public function getCache() {
		return $this->_cache;
	}

	/**
	 * Pobiera helper na podstawie nazwy z uwzględnieniem ścieżek do helperów
	 * @param string $name nazwa
	 * @return \Mmi\View\Helper\Abstract
	 */
	public function getHelper($name) {
		$name = ucfirst($name);
		$structure = \Mmi\Controller\Front::getInstance()->getStructure();
		foreach ($structure['library'] as $libName => $lib) {
			if (isset($lib['View']['Helper'][$name])) {
				$className = $libName . '\View\Helper\\' . $name;
			}
		}
		if (isset($this->request) && isset($structure['module'][$this->request->module]['View']['Helper'][$name])) {
			$className = ucfirst($this->request->module) . '\View\Helper\\' . $name;
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
	 * @return \Mmi\View\Helper\Abstract
	 */
	public function getFilter($name) {
		$name = ucfirst($name);
		$structure = \Mmi\Controller\Front::getInstance()->getStructure();
		foreach ($structure['library'] as $libName => $lib) {
			if (isset($lib['Filter'][$name])) {
				$className = $libName . '\Filter\\' . $name;
			}
		}
		if (isset($this->request) && isset($structure['module'][$this->request->module]['Filter'][$name])) {
			$className = ucfirst($this->request->module) . '\Filter\\' . $name;
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
	 * @return \Mmi\View
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
		\Mmi\Profiler::event('View direct build: ' . $hash);
		if (!$this->_locale && $this->_translate !== null) {
			$this->_locale = $this->_translate->getLocale();
		}
		$compileName = $this->_locale . '-direct-' . $hash . '.php';
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
		\Mmi\Profiler::event('View direct fetched: ' . $hash);
		return $data;
	}

	/**
	 * Ustawia wyłączenie layoutu
	 * @param boolean $disabled wyłączony
	 * @return \Mmi\View
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
		\Mmi\Profiler::event('View build: ' . basename($fileName));
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
		\Mmi\Profiler::event('View fetched: ' . $compileName);
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
		$structure = \Mmi\Controller\Front::getInstance()->getStructure();
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
		if (isset($structure['skin'][$skin]['core']['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/core/scripts/layout.tpl';
		}
		//default / core
		if (isset($structure['skin']['default']['core']['layout'])) {
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
		$structure = \Mmi\Controller\Front::getInstance()->getStructure();
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
