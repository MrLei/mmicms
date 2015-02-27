<?php

namespace Cms\Model\File;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $class;
	public $mimeType;
	public $name;
	public $original;
	public $title;
	public $author;
	public $source;
	public $size;
	public $dateAdd;
	public $dateModify;
	public $order;
	public $sticky;
	public $object;
	public $objectId;
	public $cmsAuthId;
	public $active;

	/**
	 * Ustawia plik jako przyklejony w obrębie danego object+objectId
	 * @return bool
	 */
	public function setSticky() {
		if ($this->id === null) {
			return false;
		}
		//wyłącza sticky na innych plikach dla tego object+objectId
		foreach (\Cms\Model\File\Dao::stickyByObjectQuery($this->object, $this->objectId)->find() as $related) {
			$related->sticky = 0;
			$related->save();
		}
		$this->sticky = 1;
		return $this->save();
	}

	/**
	 * Pobiera hash dla danej nazwy pliku
	 * @param string $name nazwa pliku
	 * @return string
	 */
	public function getHashName() {
		if ($this->id === null) {
			return;
		}
		return substr(md5($this->name . \Core\Registry::$config->application->salt), 0, 8);
	}

	/**
	 * Pobiera fizyczną ścieżkę do pliku
	 * @return type
	 */
	public function getRealPath() {
		if (strlen($this->name) < 3) {
			return;
		}
		return DATA_PATH . '/' . $this->name[0] . $this->name[1] . $this->name[2] . '/' . $this->name;
	}

	/**
	 * Zwraca binarną zawartość pliku
	 * @return mixed
	 */
	public function getBinaryContent() {
		$path = $this->getRealPath();
		if (empty($path)) {
			return null;
		}
		$content = file_get_contents($path);
		if ($content !== false) {
			return $content;
		}
		return null;
	}

	/**
	 * Pobiera adres pliku
	 * @param string $scaleType: scale, scalex, scaley, scalecrop
	 * @param string $scale: 320, 320x240
	 * @return string adres publiczny pliku
	 */
	public function getUrl($scaleType = 'default', $scale = 0) {
		if ($this->id === null || strlen($this->name) < 3) {
			return;
		}
		$inputFile = $this->getRealPath();
		$baseUrl = \Mmi\Controller\Front::getInstance()->getView()->baseUrl . '/data';
		$fileName = '/' . $this->name[0] . $this->name[1] . $this->name[2] . '/' . $scaleType . '/' . $scale . '/' . $this->name;
		if (file_exists(PUBLIC_PATH . '/data' . $fileName)) {
			return $baseUrl . $fileName;
		}
		if (!file_exists($inputFile)) {
			return;
		}
		if ($this->class == 'image') {
			if (!$this->_scaler($inputFile, PUBLIC_PATH . '/data' . $fileName, $scaleType, $scale)) {
				return;
			}
		} else {
			if (!copy($inputFile, PUBLIC_PATH . '/data' . $fileName)) {
				return;
			}
		}
		return $baseUrl . $fileName;
	}

	/**
	 * Makes the tumb and return its address
	 *
	 * @param string $inputFile
	 * @param string $outputFile
	 * @param string $scaleType
	 * @param string $scale
	 * @return string
	 */
	protected function _scaler($inputFile, $outputFile, $scaleType, $scale) {
		switch ($scaleType) {
			case 'default':
				$imgRes = \Mmi\Image::inputToResource($inputFile);
				break;
			case 'scale':
				$v = explode('x', $scale);
				if (count($v) == 1 && is_numeric($v[0]) && intval($v[0]) > 0) {
					$imgRes = \Mmi\Image::scale($inputFile, $v[0]);
				} elseif (count($v) == 2 && is_numeric($v[0]) && intval($v[0]) > 0 && is_numeric($v[1]) && intval($v[1]) > 0) {
					$imgRes = \Mmi\Image::scale($inputFile, $v[0], $v[1]);
				}
				break;
			case 'scalex':
				$imgRes = \Mmi\Image::scalex($inputFile, intval($scale));
				break;
			case 'scaley':
				$imgRes = \Mmi\Image::scaley($inputFile, intval($scale));
				break;
			case 'scalecrop':
				$v = explode('x', $scale);
				if (is_numeric($v[0]) && intval($v[0]) > 0 && is_numeric($v[1]) && intval($v[1]) > 0) {
					$imgRes = \Mmi\Image::scaleCrop($inputFile, $v[0], $v[1]);
				}
				break;
		}
		if (!isset($imgRes)) {
			return false;
		}
		if (!file_exists(dirname($outputFile)) && !@mkdir(dirname($outputFile), 0777, true)) {
			return true;
		}
		switch (\Mmi\Lib::mimeType($inputFile)) {
			case 'image/png':
				imagejpeg($imgRes, $outputFile, 92);
				break;
			case 'image/gif':
				imagegif($imgRes, $outputFile);
				break;
			default:
				imagejpeg($imgRes, $outputFile, 92);
				break;
		}
		return true;
	}

	/**
	 * Usuwa plik, fizycznie i z bazy danych
	 * @return boolean
	 */
	public function delete() {
		if ($this->id === null) {
			return false;
		}
		if (file_exists($this->getRealPath()) && is_writable($this->getRealPath())) {
			unlink($this->getRealPath());
		}
		$path = PUBLIC_PATH . '/data/' . $this->name[0] . $this->name[1] . $this->name[2] . '/';
		$this->_unlink($path, $this->name);
		return parent::delete();
	}

	protected function _unlink($path, $name) {
		foreach (glob($path . '*') as $file) {
			if (is_dir($file)) {
				$this->_unlink($file . '/', $name);
			} elseif (basename($file) == $name) {
				unlink($file);
			}
		}
	}

}
