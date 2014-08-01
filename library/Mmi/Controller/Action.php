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
 * Mmi/Controller/Action.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Kontroler akcji
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Action {

	/**
	 * Żądanie
	 * @var Mmi_Controller_Request
	 */
	protected $_request;
	
	/**
	 * Referencja do odpowiedzi z Front controllera
	 * @var Mmi_Controller_Response
	 */
	protected $_response;

	/**
	 * Referencja do brokera helperów controlera akcji
	 * @var Mmi_Controller_Action_HelperBroker
	 */
	protected $_helper;

	/**
	 * Widok
	 * @var Mmi_View
	 */
	public $view;

	/**
	 * Konstruktor
	 */
	public function __construct(Mmi_Controller_Request $request) {
		//request
		$this->_request = $request;
		//response
		$this->_response = Mmi_Controller_Front::getInstance()->getResponse();
		//inicjalizacja domyślna
		$this->_init();
		//inicjacja programisty kontrolera
		$this->init();
	}

	/**
	 * Magiczne pobranie zmiennej z requestu
	 * @param mixed $name wartość zmiennej
	 */
	public final function __get($name) {
		return $this->_getParam($name);
	}

	/**
	 * Łapacz nieodnalezionej metody
	 * rzuca wyjątkiem
	 * @param string $name nazwa metody
	 * @param array $params parametry metody
	 */
	public final function __call($name, array $params = array()) {
		throw new Exception('Method '. $name .' not found in class: ' . get_class($this));
	}

	/**
	 * Funkcja dla użytkownika ładowana na końcu konstruktora
	 */
	public function init() {}

	/**
	 * Pobiera request
	 * @return Mmi_Controller_Request
	 */
	public final function getRequest() {
		return $this->_request;
	}
	
	/**
	 * Pobiera response
	 * @return Mmi_Controller_Response
	 */
	public final function getResponse() {
		return $this->_response;
	}

	/**
	 * Pobiera helper brokera
	 * @return Mmi_Controller_Action_HelperBroker
	 */
	public final function getHelperBroker() {
		return $this->_helper;
	}

	/**
	 * Pobiera parametr z requestu
	 * @param string $name nazwa parametru
	 * @return mixed wartość
	 */
	protected final function _getParam($name) {
		return $this->_request->getParam($name);
	}

	/**
	 * Konfiguruje kontroler akcji
	 */
	private function _init() {
		//przypięcie widoku
		$this->view = Mmi_Controller_Front::getInstance()->getView();

		//inicjalizacja tłumaczeń
		$this->_initTranslaction($this->_request->__get('module'), $this->_request->__get('skin'), $this->_request->__get('lang'));

		//tworzenie brokera helperów kontrolera
		$this->_helper = new Mmi_Controller_Action_HelperBroker($this->_request);
	}

	/**
	 * Inicjalizacja tłumaczeń
	 * @param string $module nazwa modułu
	 * @param string $skin nazwa skóry
	 * @param string $lang język
	 * @return mixed wartość
	 */
	private function _initTranslaction($module, $skin, $lang) {

		$translate = $this->view->getTranslate();

		//dodawanie tłumaczeń
		if ($lang === null || $lang == $translate->getDefaultLocale()) {
			return;
		}

		//ładowanie zbuforowanego translatora
		$cache = $this->view->getCache();
		$key = 'Mmi_Translate_' . $lang . '_' . $skin . '_' . $module;
		
		if ($cache !== null && (null !== ($cachedTranslate = $cache->load($key)))) {
			$this->view->setTranslate($cachedTranslate);
			$translate->setLocale($lang);
			Mmi_Profiler::event('Init cached translate: [' . $lang . '] ' . $module);
			return;
		}

		//dodawanie tłumaczeń do translatora
		if (file_exists(APPLICATION_PATH . '/skins/default/default/i18n/' . $lang . '.ini')) {
			$translate->addTranslation(APPLICATION_PATH . '/skins/default/default/i18n/' . $lang . '.ini', $lang);
		}
		if ($module != 'default' && file_exists(APPLICATION_PATH . '/skins/default/' . $module . '/i18n/' . $lang . '.ini')) {
			$translate->addTranslation(APPLICATION_PATH . '/skins/default/' . $module . '/i18n/' . $lang . '.ini', $lang);
		}
		if ($skin != 'default' && file_exists(APPLICATION_PATH . '/skins/' . $skin . '/default/i18n/' . $lang . '.ini')) {
			$translate->addTranslation(APPLICATION_PATH . '/skins/' . $skin . '/default/i18n/' . $lang . '.ini', $lang);
		}
		if ($skin != 'default' && $module != 'default' && file_exists(APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/i18n/' . $lang . '.ini')) {
			$translate->addTranslation(APPLICATION_PATH . '/skins/' . $skin . '/' . $module . '/i18n/' . $lang . '.ini', $lang);
		}
		$translate->setLocale($lang);

		//zapis do cache
		if ($cache !== null) {
			$cache->save($translate, $key);
		}

		Mmi_Profiler::event('Init Translate: [' . $lang . '] ' . $module);
	}
	
}