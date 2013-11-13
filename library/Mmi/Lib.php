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
 * Mmi/Lib.php
 * @category   Mmi
 * @package    Mmi_Lib
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Statyczna biblioteka zawierająca użyteczne metody ogólnego zastosowania
 * @category   Mmi
 * @package    Mmi_Lib
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Lib {

	/**
	 * Zwraca referer lub null (jeśli brak)
	 * @return mixed
	 */
	public static function ref() {
		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
	}

	/**
	 * Kasuje pliki rekurencyjnie
	 * @param string $fileName nazwa pliku
	 * @param string $rootName katalog główny
	 */
	public static function unlinkRecursive($fileName, $rootName) {
		foreach (glob($rootName . '/*') as $file) {
			if ($fileName == basename($file) && is_file($file)) {
				unlink($file);
			} elseif (is_dir($file)) {
				self::unlinkRecursive($fileName, $file);
			}
		}
	}

	/**
	 * Kalkuluje hash tabeli
	 * @param array $table tabela
	 * @return string
	 */
	private static function _calculateTableHash(array $table) {
		return md5(print_r($table, true));
	}

	/**
	 * Koduje tabelę i zaszywa sumę kontrolną
	 * @param array $table tabela
	 * @return string
	 */
	public static function hashTable(array $table) {
		$table['_hash'] = self::_calculateTableHash($table);
		return base64_encode(serialize($table));
	}

	/**
	 * Dekoduje tabelę i sprawdza integralność danych
	 * @param string $hashedTable
	 * @return array
	 */
	public static function unhashTable($hashedTable) {
		$table = @unserialize(base64_decode($hashedTable));
		if (!is_array($table)) {
			return false;
		}
		if (!isset($table['_hash'])) {
			return false;
		}
		$targetHash = $table['_hash'];
		unset($table['_hash']);
		if (self::_calculateTableHash($table) != $targetHash) {
			return false;
		}
		return $table;
	}

	/**
	 * Zwraca mimetype pliku
	 * @param string $file fizyczny adres pliku
	 * @return string
	 */
	public static function mimeType($file) {
		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			return finfo_file($finfo, $file);
		} else {
			ob_start();
			system('/usr/bin/file -i -b ' . realpath($file));
			$type = ob_get_clean();
			$parts = explode(';', $type);
			if (isset($parts[0])) {
				return trim($parts[0]);
			} else {
				return 'application/octet-stream';
			}
		}
	}

	/**
	 * Konwertuje rozmiar w bajtach do formatu przyjaznego dla oka (wraz z jednostką)
	 * @param int $size rozmiar w bajtach
	 * @param int $digitsAfterDot miejsc po przecinku
	 * @param int $row rząd 0-bajt, 1-kilo bajt itd.
	 * @return string
	 */
	public static function bytes2human($size, $digitsAfterDot = 2, $row = 0) {
		while ($size > 1024) {
			$row++;
			$size = $size / 1024;
		}
		switch ($row) {
			case '0': $row = 'B';
				break;
			case '1': $row = 'KB';
				break;
			case '2': $row = 'MB';
				break;
			case '3': $row = 'GB';
				break;
			case '4': $row = 'TB';
				break;
			case '5': $row = 'PB';
				break;
			case '6': $row = 'EB';
				break;
		}
		return round($size, $digitsAfterDot) . ' ' . $row;
	}

	/**
	 * Szyfruje dane 256 bitowym AES-em i koduje do base64
	 * @param string $data Ciąg wejściowy
	 * @param string $key Dodatkowy klucz szyfrowania.
	 */
	public static function encrypt($data, $key = '', $salt = '') {
		$key = substr(base64_encode(hash('sha512', sha1($key) . $key . $salt, true)), 10, 26);
		//AES - Advanced Encryption Standard
		$algorithm = MCRYPT_RIJNDAEL_256;
		$procedure = MCRYPT_MODE_ECB;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $procedure), MCRYPT_RAND);
		$encrypted = mcrypt_encrypt($algorithm, $key, $data, $procedure, $iv);
		$encrypted = base64_encode($encrypted);
		return $encrypted;
	}

	/**
	 * Deszyfruje dane zaszyfrowane Mmi_Lib::encrypt()
	 * @param string $data Ciąg zaszyfrowany
	 * @param string $key Dodatkowy klucz deszyfrowania.
	 */
	public static function decrypt($data, $key = '', $salt = '') {
		$key = substr(base64_encode(hash('sha512', sha1($key) . $key . $salt, true)), 10, 26);
		//AES - Advanced Encryption Standard
		$algorithm = MCRYPT_RIJNDAEL_256;
		$procedure = MCRYPT_MODE_ECB;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $procedure), MCRYPT_RAND);
		$data = base64_decode($data);
		$decrypted = mcrypt_decrypt($algorithm, $key, $data, $procedure, $iv);
		$decrypted = rtrim($decrypted, "\0");
		return $decrypted;
	}

	/**
	 * Zrzuca zmienną
	 * @param mixed $var zmienna do zrzucenia
	 */
	public static function dump($var) {
		echo '<pre>' . print_r($var, true) . '</pre>';
	}

	/**
	 * Zwraca charakter dla indeksu w utf-8
	 * @param int $ord wartość liczbowa
	 * @return string
	 */
	public static function utf8Chr($ord) {
		return mb_convert_encoding(pack('n', $ord), 'UTF-8', 'UTF-16BE');
	}

	/**
	 * Zwraca indeks dla charakteru w utf-8
	 * @param char $chr charakter
	 * @return int | bool false jeśli poza zakresem utf-8
	 */
	public static function utf8Ord($chr) {
		if (strlen($chr) == 1) {
			return ord($chr);
		}
		$h = ord($chr{0});

		if ($h <= 0x7F) {
			return $h;
		}
		if ($h < 0xC2) {
			return false;
		}
		if ($h <= 0xDF) {
			return ($h & 0x1F) << 6 | (ord($chr{1}) & 0x3F);
		}
		if ($h <= 0xEF) {
			return ($h & 0x0F) << 12 | (ord($chr{1}) & 0x3F) << 6 | (ord($chr{2}) & 0x3F);
		}
		if ($h <= 0xF4) {
			return ($h & 0x0F) << 18 | (ord($chr{1}) & 0x3F) << 12 | (ord($chr{2}) & 0x3F) << 6 | (ord($chr{3}) & 0x3F);
		}
		return false;
	}

}