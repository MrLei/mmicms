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
 * Mmi/Controller/Action.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Kontroler akcji
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Action {

	/**
	 * Referencja do żądania
	 * @var Mmi_Request
	 */
	protected $_request;

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
		//widok
		$this->view = Mmi_Controller_Front::getInstance()->getView();
		$lang = $this->_request->__get('lang');
		$skin = $this->_request->__get('skin');
		$module = $this->_request->__get('module');

		//zmienne widoku
		$this->view->setRequest($this->_request);
		$this->view->module = $module;
		$this->view->lang = $lang;
		$this->view->skin = $skin;

		//inicjalizacja tłumaczeń
		$this->_initTranslaction($module, $skin, $lang);

		//tworzenie brokera helperów kontrolera
		$this->_helper = new Mmi_Controller_Action_HelperBroker($this);
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

		//brak translatora
		if ($translate === null) {
			return;
		}

		$cache = $this->view->getCache();
		$key = 'Mmi_Translate_' . $lang . '_' . $skin . '_' . $module;

		//dodawanie tłumaczeń
		if ($lang == $translate->getDefaultLocale()) {
			return;
		}

		//ładowanie zbuforowanego translatora
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