<?php

class Cms_Model_File_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_file';

	/**
	 * Pobiera pliki w klasach image, other
	 * @param string $object obiekt
	 * @param int $objectId id obiektu
	 * @return array
	 */
	public static function getClassified($object, $objectId) {
		$files = self::byObjectQuery($object, $objectId)
			->whereActive()->equals(1)
			->find();
		$classes = array('image' => array(), 'other' => array());
		foreach ($files AS $file) { /* @var $file Cms_Model_File_Record */
			if ($file->class == 'image') {
				$classes['image'][] = $file;
			} else {
				$classes['other'][] = $file;
			}
		}
		return $classes;
	}

	/**
	 * 
	 * @param string $object
	 * @param string $objectId
	 * @return Cms_Model_File_Query
	 */
	public static function byObjectQuery($object = null, $objectId = null) {
		return Cms_Model_File_Query::factory()
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId)
				->orderAscOrder();
	}

	/**
	 * 
	 * @param string $object
	 * @param string $objectId
	 * @return Cms_Model_File_Query
	 */
	public static function imagesByObjectQuery($object = null, $objectId = null) {
		return self::byObjectQuery($object, $objectId)
				->whereClass()->equals('image');
	}

	/**
	 * 
	 * @param string $object
	 * @param string $objectId
	 * @return Cms_Model_File_Query
	 */
	public static function stickyByObjectQuery($object = null, $objectId = null, $class = null) {
		$q = self::byObjectQuery($object, $objectId)
				->whereSticky()->equals(1);
		if (null !== $class) {
			$q->andFieldClass()->equals($class);
		}
		return $q;
	}

	/**
	 * 
	 * @param string $object
	 * @param string $objectId
	 * @return Cms_Model_File_Query
	 */
	public static function notImagesByObjectQuery($object = null, $objectId = null) {
		return self::byObjectQuery($object, $objectId)
				->whereClass()->notEquals('image');
	}

	/**
	 * Dołącza pliki dla danego object i id
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela plików
	 * @return Cms_Model_File_Dao
	 */
	public static function appendFiles($object, $id = null, array $files = array()) {
		foreach ($files as $fileSet) {
			foreach ($fileSet as $file) {
				$record = new Cms_Model_File_Record();
				$name = md5(microtime(true) . $file['tmp_name']) . substr($file['name'], strrpos($file['name'], '.'));
				$dir = DATA_PATH . '/' . $name[0] . $name[1] . $name[2];
				if (!file_exists($dir)) {
					mkdir($dir, 0777, true);
				}
				chmod($file['tmp_name'], 0664);
				copy($file['tmp_name'], $dir . '/' . $name);
				$class = explode('/', $file['type']);
				if (isset($file['title'])) {
					$record->title = $file['title'];
				}
				if (isset($file['author'])) {
					$record->author = $file['author'];
				}
				if (isset($file['source'])) {
					$record->source = $file['source'];
				}
				$record->class = $class[0];
				$record->mimeType = $file['type'];
				$record->name = $name;
				$record->original = $file['name'];
				$record->size = $file['size'];
				$record->dateAdd = date('Y-m-d');
				$record->dateModify = date('Y-m-d');
				$record->object = $object;
				$record->objectId = $id;
				$record->cmsAuthId = Default_Registry::$auth->getId();
				$record->active = 1;
				$record->save();
			}
		}
		return true;
	}

	/**
	 * Dołącza pliki dla danego object i id bezpośrednio z serwera
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela nazw plików na serwerze
	 * @return Cms_Model_File_Dao
	 */
	public static function appendFilesDirect($object, $id = null, array $files = array()) {
		foreach ($files as $file) {
			$record = new Cms_Model_File_Record();
			$name = md5(microtime(true) . $file) . substr($file, strrpos($file, '.'));
			$dir = DATA_PATH . '/' . $name[0] . $name[1] . $name[2];
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			$mimeType = Mmi_Lib::mimeType($file);
			$class = explode('/', $mimeType);
			copy($file, $dir . '/' . $name);
			$record->class = $class[0];
			$record->mimeType = $mimeType;
			$record->name = $name;
			$record->original = substr($file, strrpos($file, '/') + 1);
			$record->size = filesize($file);
			$record->dateAdd = date('Y-m-d H:i:s');
			$record->dateModify = date('Y-m-d H:i:s');
			$record->object = $object;
			$record->objectId = $id;
			$record->cmsAuthId = Default_Registry::$auth->getId();
			$record->active = 1;
			$record->save();
		}
		return true;
	}

	/**
	 * Dołącza pliki dla danego object i id przesłane w postaci binarnej
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela z nazwami i binarnymi zawartościami plików
	 * @return boolean|array tablica z PK dodanych plików
	 */
	public static function appendFilesFromBinary($object, $id = null, array $files = array()) {
		$ids = array();
		foreach ($files as $file) {
			$record = new Cms_Model_File_Record();
			$name = md5(microtime(true) . $file['name']) . substr($file['name'], strrpos($file['name'], '.'));
			$dir = DATA_PATH . '/' . $name[0] . $name[1] . $name[2];
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			$path = $dir . '/' . $name;
			$result = file_put_contents($path, $file['content']);
			if ($result === false) {
				return false;
			}
			$mimeType = Mmi_Lib::mimeType($path);
			$class = explode('/', $mimeType);
			$record->class = $class[0];
			$record->mimeType = $mimeType;
			$record->name = $name;
			$record->original = $file['name'];
			$record->size = filesize($path);
			$record->dateAdd = date('Y-m-d H:i:s');
			$record->dateModify = date('Y-m-d H:i:s');
			$record->object = $object;
			$record->objectId = $id;
			$record->active = 1;
			if ($record->save()) {
				$ids[] = $record->getPk();
			} else {
				return false;
			}
		}
		return $ids;
	}

	/**
	 * Przenosi plik z jednego obiektu na inny
	 * @param string $srcObject obiekt źródłowy
	 * @param int $srcId id źródła
	 * @param string $destObject obiekt docelowy
	 * @param int $destId docelowy id
	 * @param int ilość przeniesionych
	 */
	public static function move($srcObject, $srcId, $destObject, $destId) {
		$i = 0;
		foreach (self::byObjectQuery($srcObject, $srcId)->find() as $file) {
			$file->object = $destObject;
			$file->objectId = $destId;
			$file->save();
			$i++;
		}
		return $i;
	}

	/**
	 * Sortuje po zserializowanej tabeli identyfikatorów
	 * @param array $serial tabela identyfikatorów
	 * @return bool
	 */
	public static function sortBySerial(array $serial = array()) {
		foreach ($serial as $order => $id) {
			$record = new Cms_Model_File_Record();
			$record->setNew(false);
			$record->id = $id;
			$record->order = $order;
			$record->save();
		}
		return true;
	}

}
