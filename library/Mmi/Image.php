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
 * Mmi/Image.php
 * @category   Mmi
 * @package    Mmi_Image
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa obsługi obrazów
 * @category   Mmi
 * @package    Mmi_Image
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Image {

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

	public static function crop($input, $x, $y, $newWidth, $newHeight) {
		$input = self::_resource($input);
		if (!$input) {
			return;
		}
		$destination = imagecreatetruecolor($newWidth, $newHeight);
		imagecopy($destination, $input, 0, 0, $x, $y, $newWidth, $newHeight);
		return $destination;
	}

	protected static function _resource($input) {
		if (gettype($input) == 'string') {
			try {
				return imagecreatefromstring(file_get_contents($input));
			} catch (Exception $e) {
				return;
			}
		}
		return $input;
	}

}