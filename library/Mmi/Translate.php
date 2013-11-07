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
 * Mmi/Translate.php
 * @category   Mmi
 * @package    Mmi_Translate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa tłumaczeń (obsługa wersji językowych)
 * posiada skojarzoną klasę helpera widoku: Mmi_View_Helper_Translate
 * @see Mmi_View_Helper_Translate
 * @category   Mmi
 * @package    Mmi_Translate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Translate {

	/**
	 * Dane językowe
	 * @var array
	 */
	private $_data = array();

	/**
	 * Dostępne języki
	 * @var array
	 */
	private $_languages = array();

	/**
	 * Bieżąca wersja językowa
	 * @var string
	 */
	private $_locale;

	/**
	 * Domyślna wersja językowa
	 * @var string
	 */
	private $_defaultLocale;

	/**
	 * Konstruktor, dodający opcjonalnie tłumaczenie
	 * @param string $sourceFile ścieżka do pliku
	 * @param string $locale wersja językowa podanego pliku
	 */
	public function __construct($sourceFile = null, $locale = null) {
		if (null !== $sourceFile && null !== $locale) {
			$this->addTranslation($sourceFile, $locale);
		} elseif (null !== $locale) {
			$this->setLocale($locale);
		}
		//przypinanie nowego translatora do widoku
		Mmi_View_Helper_Translate::setTranslate($this);
	}

	/**
	 * Dodaje tłumaczenie
	 * @param string $sourceFile ścieżka do pliku
	 * @param string $locale wersja językowa podanego pliku
	 * @return Mmi_Translate
	 */
	public function addTranslation($sourceFile, $locale) {
		$data = $this->_parseTranslationFile($sourceFile, $locale == $this->_defaultLocale);
		$this->_languages[$locale] = $sourceFile;
		if (isset($this->_data[$locale])) {
			$data = array_merge($this->_data[$locale], $data);
		}
		$this->_data[$locale] = $data;
		return $this;
	}

	/**
	 * Pobiera bieżącą wersję językową
	 * @return string
	 */
	public function getLocale() {
		return $this->_locale;
	}

	/**
	 * Domyślny język
	 * @return string
	 */
	public function getDefaultLocale() {
		return $this->_defaultLocale;
	}

	/**
	 * Ustawia bieżącą wersję językową
	 * @param string $locale wersja językowa
	 * @return Mmi_Translate
	 */
	public function setLocale($locale) {
		$this->_locale = $locale;
		return $this;
	}

	/**
	 * Ustawia domyślną wersję językową
	 * @param string $locale wersja językowa
	 * @return Mmi_Translate
	 */
	public function setDefaultLocale($locale) {
		$this->_defaultLocale = $locale;
		return $this;
	}

	/**
	 * Alias metody _ (podkreślenie)
	 * @see Mmi_Translate::_()
	 * @return string
	 */
	public function translate($key) {
		return $this->_($key);
	}

	/**
	 * Tłumaczy ciąg znaków, działając analogicznie do sprintf
	 * przykład : :translate('number %d', 12) wyświetli np. "liczba 12"
	 * @return string
	 */
	public function _($key) {
		if ($this->_locale == $this->_defaultLocale) {
			return $key;
		} elseif (isset($this->_data[$this->_locale][$key])) {
			return $this->_data[$this->_locale][$key];
		}
		$this->_logUntranslated($key);
		return $key;
	}

	/**
	 * Parsuje plik z tłumaczeniem
	 * @param string $sourceFile plik źródłowy
	 * @param boolean $isDefaultLocale czy wersja językowa jest domyślna
	 * @return array
	 */
	private function _parseTranslationFile($sourceFile, $isDefaultLocale) {
		if (!file_exists($sourceFile)) {
			return;
		}
		$data = file_get_contents($sourceFile);
		$data = str_replace("\r\n", '\n', $data);
		$data = explode("\n", $data);
		$output = array();
		foreach ($data as $line) {
			if (strlen($line) > 0) {
				$line = explode(" = ", $line);
				if (isset($line[0])) {
					$key = trim($line[0]);
					if ($isDefaultLocale) {
						$output[$key] = isset($line[1]) ? trim($line[1]) : $key;
					} else {
						$output[$key] = isset($line[1]) ? trim($line[1]) : null;
					}
				}
			}
		}
		return $output;
	}

	/**
	 * Loguje nieprzetłumaczone teksty do pliku
	 * @param string $key klucz
	 */
	private function _logUntranslated($key) {
		$log = fopen(TMP_PATH . '/log/error.translation.log', 'a');
		fwrite($log, date('Y-m-d H:i:s') . ' ' . $_SERVER['REQUEST_URI'] . ' [' . $this->_locale . '] {#' . $key . "#}\n");
		fclose($log);
	}

}
