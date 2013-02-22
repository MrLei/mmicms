<?php

class Cms_Model_File_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_file';

	/**
	 * Pobiera pliki w klasach image, other
	 * @param string $object obiekt
	 * @param int $objectId id obiektu
	 * @return array
	 */
	public static function findClassified($object, $objectId) {
		$files = self::find(array(
				array('objectId', $objectId),
				array('object', $object),
				array('active', 1)
				), array('order')
		);
		$classes = array('image' => array(), 'other' => array());
		foreach ($files AS $file) {
			$file->hash = $file->getHashName();
			if ($file->class == 'image') {
				$classes['image'][] = $file;
			} else {
				$classes['other'][] = $file;
			}
		}
		if (empty($classes['image'])) {
			unset($classes['image']);
		}
		if (empty($classes['other'])) {
			unset($classes['other']);
		}
		return $classes;
	}

	/**
	 * Zwraca pierwszy przyklejony plik
	 * @param string $object
	 * @param integer $id
	 * @param string $class
	 * @return Cms_Model_File_Record
	 */
	public static function findFirstSticky($object, $id, $class = null) {
		$params = array(
			array('sticky', '1'),
			array('objectId', $id),
			array('object', $object)
		);
		if (null !== $class) {
			$params[] = array('class', $class);
		}
		return self::findFirst($params);
	}

	/**
	 * Zwraca pierwszy obraz
	 * @param string $object
	 * @param integer $id
	 * @param string $class
	 * @return Cms_Model_File_Record
	 */
	public static function findFirstImage($object, $id, $class = null) {
		return self::findFirst(array(
				array('class', 'image'),
				array('object', $object),
				array('objectId', $id)
				), array('order')
		);
	}

	/**
	 * Zwraca kolecję modeli pliku z obrazami dla podanego obiektu i jego id
	 * @param string $object
	 * @param integer $id
	 * @return Mmi_Dao_Collection
	 */
	public static function findImages($object = null, $id = null) {
		return self::find(array(
				array('class', 'image'),
				array('object', $object),
				array('objectId', $id)
				), array('order')
		);
	}

	/**
	 * Zwraca kolecję modeli pliku z nie-obrazami dla podanego obiektu i jego id
	 * @param string $object
	 * @param integer $id
	 * @return Mmi_Dao_Collection
	 */
	public static function findNotImages($object = null, $id = null) {
		return self::find(array(
				array('class', 'image', '!='),
				array('object', $object),
				array('objectId', $id)
				), array('order')
		);
	}

	/**
	 * Dołącza pliki dla danego object i id
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela plików
	 * @return Cms_Model_File_Dao
	 */
	public static function appendFiles($object, $id, array $files = array()) {
		foreach ($files as $file) {
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
			$record->cms_auth_id = Mmi_Auth::getInstance()->getId();
			$record->active = 1;
			$record->save();
		}
		return true;
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
		foreach (self::find(array(
			array('object', $srcObject),
			array('objectId', $srcId)
		)) as $file) {
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