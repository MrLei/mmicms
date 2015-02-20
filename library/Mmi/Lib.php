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
 * Mmi/Lib.php
 * @category   Mmi
 * @package    \Mmi\Lib
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Statyczna biblioteka zawierająca użyteczne metody ogólnego zastosowania
 * @category   Mmi
 * @package    \Mmi\Lib
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Lib {

	/**
	 * Kasuje pliki rekurencyjnie
	 * @param string $fileName nazwa pliku
	 * @param string $rootName katalog główny
	 */
	public static function unlinkRecursive($fileName, $rootName) {
		if (!file_exists($rootName)) {
			return;
		}
		foreach (glob($rootName . '/*') as $file) {
			if ($fileName == basename($file) && is_file($file)) {
				unlink($file);
				continue;
			}
			if (is_dir($file)) {
				self::unlinkRecursive($fileName, $file);
			}
		}
	}
	
	/**
	 * Usuwa katalog rekurencyjnie
	 * @param string $dirName nazwa katalogu
	 */
	public static function rmdirRecursive($dirName) {
		if (!file_exists($dirName)) {
			return false;
		}
		foreach (glob($dirName . '/*') as $file) {
			if (is_file($file)) {
				unlink($file);
				continue;
			} 
			if (is_dir($file)) {
				self::rmdirRecursive($file);
			}
		}
		rmdir($dirName);
		return true;
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
	 * @param string $fileAddress adres pliku
	 * @return string
	 */
	public static function mimeType($fileAddress) {
		if (!function_exists('finfo_open')) {
			throw new Exception('Fileinfo plugin not installed');
		}
		return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $fileAddress);
	}
	
	/**
	 * Zwraca mimetype pliku binarnego
	 * @param string $binary plik binarny
	 * @return string
	 */
	public static function mimeTypeBinary($binary) {
		if (!function_exists('finfo_open')) {
			throw new Exception('Fileinfo plugin not installed');
		}
		return finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $binary);
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
	public static function encrypt($data, $password, $salt = '') {
		$key = substr(base64_encode(hash('sha512', $password . ':' . sha1($password) . '@Mmi#' . $salt)), 10, 32);
		//AES - Advanced Encryption Standard
		if (!defined('MCRYPT_RIJNDAEL_256')) {
		   define('MCRYPT_RIJNDAEL_256', 0);
		}
		$algorithm = MCRYPT_RIJNDAEL_256;
		if (!defined('MCRYPT_MODE_ECB')) {
		   define('MCRYPT_MODE_ECB', 0);
		}
		$procedure = MCRYPT_MODE_ECB;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $procedure), MCRYPT_RAND);
		$encrypted = mcrypt_encrypt($algorithm, $key, $data, $procedure, $iv);
		return trim(str_replace(array('+', '/'), array('-', '_'), base64_encode($encrypted)), '=');
	}

	/**
	 * Deszyfruje dane zaszyfrowane \Mmi\Lib::encrypt()
	 * @param string $data Ciąg zaszyfrowany
	 * @param string $key Dodatkowy klucz deszyfrowania.
	 */
	public static function decrypt($data, $password, $salt = '') {
		$key = substr(base64_encode(hash('sha512', $password . ':' . sha1($password) . '@Mmi#' . $salt)), 10, 32);
		//AES - Advanced Encryption Standard
		$algorithm = MCRYPT_RIJNDAEL_256;
		$procedure = MCRYPT_MODE_ECB;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $procedure), MCRYPT_RAND);
		return rtrim(mcrypt_decrypt($algorithm, $key, base64_decode(str_replace(array('-', '_'), array('+', '/'), $data)), $procedure, $iv), "\0");
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

	/**
	 * Konwertuje liczbę całkowitą do liczby o podstawie 58
	 * @param integer $num
	 * @return string
	 */
	public static function base58encode($num) {
		$alphabet = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
		$baseCount = strlen($alphabet);
		$encoded = '';
		while ($num >= $baseCount) {
			$div = $num / $baseCount;
			$mod = ($num - ($baseCount * intval($div)));
			$encoded = $alphabet[$mod] . $encoded;
			$num = intval($div);
		}
		if ($num) {
			$encoded = $alphabet[$num] . $encoded;
		}
		return $encoded;
	}

	/**
	 * Konwertuje liczbę o podstawie 58 do całkowitej
	 * @param string $base58
	 * @return integer
	 */
	public static function base58decode($base58) {
		$alphabet = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
		$len = strlen($base58);
		$decoded = 0;
		$multi = 1;
		for ($i = $len - 1; $i >= 0; $i--) {
			$decoded += $multi * strpos($alphabet, $base58[$i]);
			$multi = $multi * strlen($alphabet);
		}
		return $decoded;
	}

}
