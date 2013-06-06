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
 * Mmi/View.php
 * @category   Mmi
 * @package    Mmi_View
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa widoku
 * @see Mmi_View_Helper
 * @category   Mmi
 * @package    Mmi_View
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View {

	/**
	 * Instancja
	 * @var Mmi_View
	 */
	private static $_instance;

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
	 * Przechowuje strukturę szablonów
	 * @var array
	 */
	private $_structure = array();

	/**
	 * Obiekt requestu
	 * @var Mmi_Controller_Request
	 */
	public $request;

	/**
	 * Zabezpieczony konstruktor
	 */
	private function __construct() {
		$this->_structure = Mmi_Controller_Front::getInstance()->getStructure();
	}

	/**
	 * Pobiera instancję
	 * @return Mmi_View
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
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
	 */
	public function setRequest(Mmi_Controller_Request $request) {
		$this->request = $request;
	}

	/**
	 * Pobiera helper na podstawie nazwy z uwzględnieniem ścieżek do helperów
	 * @param string $name nazwa
	 * @return Mmi_View_Helper_Abstract
	 */
	public function getHelper($name) {
		$name = ucfirst($name);
		foreach ($this->_structure['library'] as $libName => $lib) {
			if (isset($lib['View']['Helper'][$name])) {
				$className = $libName . '_View_Helper_' . $name;
			}
		}
		if (isset($this->request) && isset($this->_structure['module'][$this->request->module]['View']['Helper'][$name])) {
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
		foreach ($this->_structure['library'] as $libName => $lib) {
			if (isset($lib['Filter'][$name])) {
				$className = $libName . '_Filter_' . $name;
			}
		}
		if (isset($this->request) && isset($this->_structure['module'][$this->request->module]['Filter'][$name])) {
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
	 */
	public function setPlaceholder($name, $content) {
		$this->_placeholders[$name] = $content;
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
	public function renderTemplate($skin, $module, $controller, $action, $fetch = false) {
		return $this->render($this->_getTemplate($skin, $module, $controller, $action), $fetch);
	}

	/**
	 * Generowanie kodu PHP z kodu szablonu w locie
	 * @param string $input kod szablonu
	 * @return string kod PHP
	 */
	public function renderDirectly($input) {
		$prev = ob_get_contents();
		ob_clean();
		$destFile = TMP_PATH . '/compile/temp_' . rand(0, 100000000000) . '.php';
		file_put_contents($destFile, $this->template($input));
		include $destFile;
		$data = ob_get_contents();
		ob_clean();
		echo $prev;
		unlink($destFile);
		return $data;
	}

	/**
	 * Ustawia wyłączenie layoutu
	 * @param boolean $disabled wyłączony
	 */
	public function setLayoutDisabled($disabled = true) {
		$this->_layoutDisabled = $disabled;
	}

	/**
	 * Wyświetla stronę
	 */
	public function displayLayout($skin, $module, $controller) {
		//wyłączony layout zwraca tylko content
		if ($this->_layoutDisabled) {
			echo $this->getPlaceholder('content');
			return;
		}
		//layouty kontrolerów admina zachowują się jak moduł admin
		$module = (substr($controller, 0, 5) == 'admin') ? 'admin' : $module;

		//renderowanie layoutu
		$this->render($this->_getLayout($skin, $module, $controller), false);

		//opcjonalne uruchomienie panelu deweloperskiego
		if (Mmi_Config::$data['global']['debug']) {
			Mmi_Profiler::event('Debugger started');
			new Mmi_View_Helper_Panel();
		}
	}

	/**
	 * Nakładka na translator
	 * @return string
	 */
	public function _() {
		$translator = Mmi_Registry::get('Mmi_Translate');
		return call_user_func_array(array($translator, '_'), func_get_args());
	}

	/**
	 * Renderuje szablon z pliku
	 * @param string $fileName nazwa pliku szablonu
	 * @param boolean $fetch nie renderuj tylko zwróć dane
	 * @return string|null zwraca efekt renderowania lub brak przy renderowaniu bezpośrednim
	 */
	public function render($fileName, $fetch = false) {
		//przechwycenie obecnego stanu bufora
		if ($fetch) {
			$prev = ob_get_contents();
			ob_clean();
		}
		if (!$this->_locale && Mmi_Registry::get('Mmi_Translate')) {
			$this->_locale = Mmi_Registry::get('Mmi_Translate')->getLocale();
		}
		$destFile = TMP_PATH . '/compile/' . $this->_locale . '_' . str_replace(array('/','\\'), '_', substr($fileName, strrpos($fileName, '/application') + 19, -4) . '.php');
		$cacheActive = isset(Mmi_Config::$data['cache']['active']) ? Mmi_Config::$data['cache']['active'] : false;
		if ($cacheActive) {
			try {
				include $destFile;
			} catch (Exception $e) {
				$input = file_get_contents($fileName);
				file_put_contents($destFile, $this->template($input, $destFile));
				include $destFile;
			}
		} else {
			$input = file_get_contents($fileName);
			file_put_contents($destFile, $this->template($input, $destFile));
			include $destFile;
		}
		if ($fetch) {
			$data = ob_get_contents();
			ob_clean();
			//zwrot starego bufora
			echo $prev;
			Mmi_Profiler::event('Fetch: ' . $fileName);
			return $data;
		} else {
			Mmi_Profiler::event('Render: ' . $fileName);
		}
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
		//skóra / moduł / kontroler
		if (isset($this->_structure['skin'][$skin][$module][$controller]['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/' . $controller . '/layout.tpl';
		}
		//default / moduł / kontroler
		if (isset($this->_structure['skin']['default'][$module][$controller]['layout'])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/' . $controller .  '/layout.tpl';
		}
		//skóra / moduł
		if (isset($this->_structure['skin'][$skin][$module]['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/layout.tpl';
		}
		//default / moduł
		if (isset($this->_structure['skin']['default'][$module]['layout'])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/layout.tpl';
		}
		//skóra / default
		if (isset($this->_structure['skin'][$skin]['default']['layout'])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/default/scripts/layout.tpl';
		}
		//default / default
		if (isset($this->_structure['skin']['default']['default']['layout'])) {
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
		if (isset($this->_structure['skin'][$skin][$module][$controller][$action])) {
			return APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/scripts/' . $controller . '/' . $action . '.tpl';
		}
		if (isset($this->_structure['skin']['default'][$module][$controller][$action])) {
			return APPLICATION_PATH . '/skins/default/' . $module . '/scripts/' . $controller . '/' . $action . '.tpl';
		}
		throw new Exception('Template not found.');
	}

}
