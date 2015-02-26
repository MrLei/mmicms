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
 * Mmi/Image/Exif.php
 * @category   Mmi
 * @package    \Mmi\Image
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa obsługi exifów
 * @category   Mmi
 * @package    \Mmi\Image
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Image;

class Exif {

	/**
	 * Dane exif
	 * @var array
	 */
	private $_exif = array();

	public function __construct($fileName) {
		$this->_exif = exif_read_data($fileName);
	}

	/**
	 * Wartość ISO
	 * @return integer
	 */
	public function getIsoSpeed() {
		return isset($this->_exif['ISOSpeedRatings']) ? round($this->_exif['ISOSpeedRatings']) : null;
	}

	/**
	 * Rodzaj aparatu
	 * @return string
	 */
	public function getCamera() {
		if (!$this->getCameraMake()) {
			return $this->getCameraModel();
		}
		if (!$this->getCameraModel()) {
			return $this->getCameraMake();
		}
		if (strpos(strtolower($this->getCameraModel()), strtolower($this->getCameraMake())) === false) {
			return $this->getCameraMake() . ' ' . $this->getCameraModel();
		}
		return $this->getCameraModel();
	}

	/**
	 * Marka aparatu
	 * @return string
	 */
	public function getCameraMake() {
		return isset($this->_exif['Make']) ? $this->_exif['Make'] : null;
	}

	/**
	 * Model aparatu
	 * @return type
	 */
	public function getCameraModel() {
		return isset($this->_exif['Model']) ? $this->_exif['Model'] : null;
	}

	/**
	 * Czas ekspozycji
	 * @return string
	 */
	public function getExposureTime() {
		if (!isset($this->_exif['ExposureTime'])) {
			return;
		}
		$arr = explode('/', $this->_exif['ExposureTime']);
		if (count($arr) == 2 && $arr[0] > 1 && $arr[1] > $arr[0]) {
			return '1/' . round($arr[1] / $arr[0]);
		}
		if (count($arr) == 2 && $arr[0] > 1 && $arr[1] > 0) {
			return round($arr[0] / $arr[1]);
		}
		return $this->_exif['ExposureTime'];
	}

	/**
	 * Przysłona
	 * @return float
	 */
	public function getAperture() {
		if (!isset($this->_exif['FNumber'])) {
			return;
		}
		$arr = explode('/', $this->_exif['FNumber']);
		if (count($arr) == 2 && $arr[1] > 0) {
			return round(($arr[0] / $arr[1]), 1);
		}
		return round($this->_exif['FNumber'], 1);
	}

	/**
	 * Data utworzenia zdjęcia
	 * @return string
	 */
	public function getCreationDate() {
		if (isset($this->_exif['DateTimeOriginal']) && substr($this->_exif['DateTimeOriginal'], 0, 4) != '0000') {
			return date('Y-m-d H:i:s', strtotime($this->_exif['DateTimeOriginal']));
		}
		if (isset($this->_exif['DateTime']) && substr($this->_exif['DateTime'], 0, 4) != '0000') {
			return date('Y-m-d H:i:s', strtotime($this->_exif['DateTime']));
		}
		if (!isset($this->_exif['FileDateTime']) && substr($this->_exif['DateTime'], 0, 4) != '0000') {
			return date('Y-m-d H:i:s', strtotime($this->_exif['FileDateTime']));
		}
	}

	/**
	 * Szerokość
	 * @return integer
	 */
	public function getWidth() {
		if (isset($this->_exif['ExifImageWidth'])) {
			return round($this->_exif['ExifImageWidth']);
		}
		return isset($this->_exif['COMPUTED']['Width']) ? round($this->_exif['COMPUTED']['Width']) : null;
	}

	/**
	 * Wysokość
	 * @return integer
	 */
	public function getHeight() {
		if (isset($this->_exif['ExifImageLength'])) {
			return round($this->_exif['ExifImageLength']);
		}
		return isset($this->_exif['COMPUTED']['Height']) ? round($this->_exif['COMPUTED']['Height']) : null;
	}

	/**
	 * Orientacja
	 * 1	top	left side
	 * 2	top	right side
	 * 3	bottom	right side
	 * 4	bottom	left side
	 * 5	left side	top
	 * 6	right side	top
	 * 7	right side	bottom
	 * 8	left side	bottom
	 * @return integer
	 */
	public function getOrientation() {
		return isset($this->_exif['Orientation']) ? intval($this->_exif['Orientation']) : null;
	}

	/**
	 * Długość geograficzna
	 * @return float
	 */
	public function getLongitude() {
		if (!isset($this->_exif['GPSLongitude']) || !isset($this->_exif['GPSLongitudeRef'])) {
			return;
		}
		if (!is_array($this->_exif['GPSLongitude']) || count($this->_exif['GPSLongitude']) != 3) {
			return;
		}
		$hours = round($this->_gpsValue($this->_exif['GPSLongitude'][0]));
		$minutes = round($this->_gpsValue($this->_exif['GPSLongitude'][1])) / 60;
		$seconds = $this->_gpsValue($this->_exif['GPSLongitude'][1]) / 3600;
		$sign = 1;
		if (strtolower($this->_exif['GPSLongitudeRef']) != 'e') {
			$sign = -1;
		}
		return $sign * ($hours + $minutes + $seconds);
	}

	/**
	 * Szerokość geograficzna
	 * @return float
	 */
	public function getLatitude() {
		if (!isset($this->_exif['GPSLatitude']) || !isset($this->_exif['GPSLatitudeRef'])) {
			return;
		}
		if (!is_array($this->_exif['GPSLatitude']) || count($this->_exif['GPSLatitude']) != 3) {
			return;
		}
		$hours = round($this->_gpsValue($this->_exif['GPSLatitude'][0]));
		$minutes = round($this->_gpsValue($this->_exif['GPSLatitude'][1])) / 60;
		$seconds = $this->_gpsValue($this->_exif['GPSLatitude'][1]) / 3600;
		$sign = 1;
		if (strtolower($this->_exif['GPSLatitudeRef']) != 'n') {
			$sign = -1;
		}
		return $sign * ($hours + $minutes + $seconds);
	}

	protected function _gpsValue($value) {
		$arr = explode('/', $value);
		if (count($arr) == 2 && $arr[1] > 0) {
			return $arr[0] / $arr[1];
		}
		return $arr;
	}

}
