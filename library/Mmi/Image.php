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
 * Mmi/Image.php
 * @category   Mmi
 * @package    \Mmi\Image
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa obsługi obrazów
 * @category   Mmi
 * @package    \Mmi\Image
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Image {

	public static function inputToResource($input) {
		return self::_resource($input);
	}

	/**
	 * Skaluje i przycina obrazek tak aby pasował do podanych wymiarów, zachowuje proporcje
	 * @param mixed $input wejście
	 * @param int $x wysokość do której chcemy przeskalować obrazek
	 * @param int $y szerokość do której chcemy przeskalować obrazek
	 * @return resource obrazek
	 */
	public static function scaleCrop($input, $x, $y) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);

		$scale = max($y / $height, $x / $width);
		$sx = round($width * $scale);
		$sy = round($height * $scale);

		$tmp = imagecreatetruecolor($sx, $sy);
		imagecopyresampled($tmp, $input, 0, 0, 0, 0, $sx, $sy, $width, $height);
		$input = $tmp;

		$tmp = imagecreatetruecolor($x, $y);
		imagecopyresized($tmp, $input, 0, 0, abs($sx - $x) / 2, abs($sy - $y) / 2, $x, $y, $x, $y);
		return $tmp;
	}

	/**
	 * Skaluje obrazek tak aby pasował do podanych wymiarów bez zachowania proporcji
	 * @param mixed $input wejście
	 * @param int $x wysokość do której chcemy przeskalować obrazek
	 * @param int $y szerokość do której chcemy przeskalować obrazek
	 * @return resource obrazek
	 */
	public static function scaleNoAspect($input, $x, $y) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);
		imagecopyresampled($tmp, $input, 0, 0, 0, 0, $x, $y, $width, $height);
		return $tmp;
	}

	/**
	 * Skaluje obrazek o podany procent zachowując proporcje
	 * @param mixed $input wejście
	 * @param int $percent procent o jaki ma być zmieniony rozmiar obrazka
	 * @return resource obrazek
	 */
	public static function scaleProportional($input, $percent) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);
		$sx = round($width * $percent / 100);
		$sy = round($height * $percent / 100);
		$tmp = imagecreatetruecolor($sx, $sy);
		imagecopyresampled($tmp, $input, 0, 0, 0, 0, $sx, $sy, $width, $height);
		return $tmp;
	}

	/**
	 * Skaluje obrazek proporcjonalnie do podanych maxymalnych wymiarów
	 * @param mixed $input wejście
	 * @param int $maxDimX wysokość do której chcemy przeskalować obrazek
	 * @param int $maxDimY szerokość do której chcemy przeskalować obrazek
	 * @return resource obrazek
	 */
	public static function scale($input, $maxDimX, $maxDimY = NULL) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);

		if (is_null($maxDimY)) {
			if ($width - $maxDimX > $height - $maxDimX) {
				return self::scalex($input, $maxDimX);
			}
			return self::scaley($input, $maxDimX);
		}

		$ratioX = $maxDimX / $width;
		$ratioY = $maxDimY / $height;

		if ($ratioX < $ratioY && $ratioX < 1) {
			return self::scaleProportional($input, $ratioX * 100);
		}
		if ($ratioY <= $ratioX && $ratioY < 1) {
			return self::scaleProportional($input, $ratioY * 100);
		}
		return $input;
	}

	/**
	 * Pomniejsza obrazek do danej szerokości zachowując proporcje, nie powiększa obrazka.
	 * @param mixed $input wejście
	 * @param int $maxDim szerokość do której chcemy pomniejszyć obrazek
	 * @return resource obrazek
	 */
	public static function scalex($input, $maxDim) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);
		if ($width > $maxDim) {
			$scale = $maxDim / $width;
			$sx = round($width * $scale);
			$sy = round($height * $scale);
			$tmp = imagecreatetruecolor($sx, $sy);
			imagecopyresampled($tmp, $input, 0, 0, 0, 0, $sx, $sy, $width, $height);
			$input = $tmp;
		}
		return $input;
	}

	/**
	 * Pomniejsza obrazek do danej wysokości zachowując proporcje, nie powiększa obrazka.
	 * @param mixed $input wejście
	 * @param int $maxDim wysokość do której chcemy pomniejszyć obrazek
	 * @return resource obrazek
	 */
	public static function scaley($input, $maxDim) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$width = imagesx($input);
		$height = imagesy($input);
		if ($height > $maxDim) {
			$scale = $maxDim / $height;
			$sx = round($width * $scale);
			$sy = round($height * $scale);
			$tmp = imagecreatetruecolor($sx, $sy);
			imagecopyresampled($tmp, $input, 0, 0, 0, 0, $sx, $sy, $width, $height);
			$input = $tmp;
		}
		return $input;
	}

	/**
	 * Obraca obrazek o dany kąt wyrażony w stopniach
	 * @param mixed $input wejście
	 * @param int $pivot kąt obrotu
	 * @return resource obrazek
	 */
	public static function rotate($input, $pivot) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$x = imagesx($input);
		$y = imagesy($input);
		$pivot = round(intval($pivot)) % 4;
		switch ($pivot) {
			case '0': return $input;
				break;
			case '1':
				$output = imagecreatetruecolor($y, $x);
				for ($i = 0; $i < $x; $i++)
					for ($j = 0; $j < $y; $j++)
						imagesetpixel($output, $j, $x - $i - 1, imagecolorat($input, $i, $j));
				break;
			case '2':
				$output = imagecreatetruecolor($x, $y);
				imagecopyresampled($output, $input, 0, 0, $x - 1, $y - 1, $x, $y, 0 - $x, 0 - $y);
				break;
			case '3':
				$output = imagecreatetruecolor($y, $x);
				for ($i = 0; $i < $x; $i++)
					for ($j = 0; $j < $y; $j++)
						imagesetpixel($output, $y - $j - 1, $i, imagecolorat($input, $i, $j));
				break;
		}
		return $output;
	}

	/**
	 * Obraca obrazek o 180 stopni
	 * @param mixed $input wejście
	 * @return resource obrazek
	 */
	public static function flip($input) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$x = imagesx($input);
		$y = imagesy($input);
		$output = imagecreatetruecolor($x, $y);
		imagecopyresampled($output, $input, 0, 0, $x - 1, 0, $x, $y, 0 - $x, $y);
		return $output;
	}

	/**
	 * Wycina fragment obrazka z punktu x,y o danej długości i wysokości
	 * @param mixed $input wejście
	 * @param int $x współrzędna x
	 * @param int $y współrzędna y
	 * @param int $newWidth nowa Szerokość
	 * @param int $newHeight nowa Wysokość
	 * @return resource obrazek
	 */
	public static function crop($input, $x, $y, $newWidth, $newHeight) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		if (imagesx($input) < $newWidth + $x) {
			$newWidth = imagesx($input) - $x;
		}
		if (imagesy($input) < $newHeight + $y) {
			$newHeight = imagesy($input) - $y;
		}
		$destination = imagecreatetruecolor($newWidth, $newHeight);
		imagecopy($destination, $input, 0, 0, $x, $y, $newWidth, $newHeight);
		return $destination;
	}

	/**
	 * Przerabia wejście w postaci String na obiekt resource 
	 * lub zwraca wejście jeśli nie jest stringiem, w przypadku
	 * błędnego wejścia zwraca false
	 * @param mixed $input wejście
	 * @return resource obrazek
	 */
	protected static function _resource($input) {
		if (gettype($input) == 'resource') {
			return $input;
		}
		try {
			if (strlen($input) < 1024) {
				$input = file_get_contents($input);
			}
			return imagecreatefromstring($input);
		} catch (\Exception $e) {
			\Mmi\Exception\Logger::log($e);
			return;
		}
	}

}
