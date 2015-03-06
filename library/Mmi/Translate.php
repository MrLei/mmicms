<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

/**
 * Obiekt tłumaczeń
 */
class Translate {

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
	}

	/**
	 * Dodaje tłumaczenie
	 * @param string $sourceFile ścieżka do pliku
	 * @param string $locale wersja językowa podanego pliku
	 * @return \Mmi\Translate
	 */
	public function addTranslation($sourceFile, $locale) {
		//jeśli brak locale - zwrot
		if ($locale === null) {
			return $this;
		}
		//parser pliku tłumaczeń
		$data = $this->_parseTranslationFile($sourceFile, $locale == $this->_defaultLocale);
		$this->_languages[$locale] = $sourceFile;
		//łączenie tłumaczeń
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
	 * @return \Mmi\Translate
	 */
	public function setLocale($locale) {
		$this->_locale = $locale;
		return $this;
	}

	/**
	 * Ustawia domyślną wersję językową
	 * @param string $locale wersja językowa
	 * @return \Mmi\Translate
	 */
	public function setDefaultLocale($locale) {
		$this->_defaultLocale = $locale;
		return $this;
	}

	/**
	 * Alias metody _ (podkreślenie)
	 * @see \Mmi\Translate::_()
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
		//jeśli brak locale, lub zgodne z domyślnym - zwrot klucza
		if ($this->_locale === null || $this->_locale == $this->_defaultLocale) {
			return $key;
		}
		//zwrot znalezionego tłumaczenia
		if (isset($this->_data[$this->_locale][$key])) {
			return $this->_data[$this->_locale][$key];
		}
		//logowanie nieprzetłumaczonego
		$this->_logUntranslated($key);
		//zwrot klucza
		return $key;
	}

	/**
	 * Parsuje plik z tłumaczeniem
	 * @param string $sourceFile plik źródłowy
	 * @param boolean $isDefaultLocale czy wersja językowa jest domyślna
	 * @return array
	 */
	private function _parseTranslationFile($sourceFile, $isDefaultLocale) {
		//wczytanie pliku
		$data = explode("\n", str_replace("\r\n", '\n', file_get_contents($sourceFile)));
		$output = array();
		//parsowanie linii
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
		//otwieranie loga
		$log = fopen(TMP_PATH . '/log/error.translation.log', 'a');
		$requestUri = \Mmi\Controller\Front::getInstance()->getEnvironment()->requestUri;
		//zapis zdarzenia
		fwrite($log, date('Y-m-d H:i:s') . ' ' . $requestUri . ' [' . $this->_locale . '] {#' . $key . "#}\n");
		fclose($log);
	}

}
