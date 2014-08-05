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
		$q = self::newQuery()
			->where('objectId')->equals($objectId)
			->andField('object')->equals($object)
			->andField('active')->equals(1)
			->orderAsc('order');

		$files = self::find($q);

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
		$q = self::newQuery()
			->where('sticky')->equals(1)
			->andField('object')->equals($object)
			->andField('objectId')->equals($id);

		if (null !== $class) {
			$q->andField('class')->equals($class);
		}
		return self::findFirst($q);
	}

	/**
	 * Zwraca pierwszy obraz
	 * @param string $object
	 * @param integer $id
	 * @return Cms_Model_File_Record
	 */
	public static function findFirstImage($object, $id) {
		$q = self::newQuery()
			->where('object')->equals($object)
			->andField('objectId')->equals($id)
			->andField('class')->equals('image')
			->orderAsc('order');
		return self::findFirst($q);
	}

	/**
	 * Zwraca kolecję modeli pliku z obrazami dla podanego obiektu i jego id
	 * @param string $object
	 * @param integer $id
	 * @return Mmi_Dao_Collection
	 */
	public static function findImages($object = null, $id = null) {
		$q = self::newQuery()
			->where('object')->equals($object)
			->andField('objectId')->equals($id)
			->andField('class')->equals('image')
			->orderAsc('order');
		return self::find($q);
	}

	/**
	 * Zwraca kolecję modeli pliku z nie-obrazami dla podanego obiektu i jego id
	 * @param string $object
	 * @param integer $id
	 * @return Mmi_Dao_Collection
	 */
	public static function findNotImages($object = null, $id = null) {
		$q = self::newQuery()
			->where('object')->equals($object)
			->andField('objectId')->equals($id)
			->andField('class')->notEquals('image')
			->orderAsc('order');
		return self::find($q);
	}

	/**
	 * Znajduje po obiekcie i id obiektu
	 * @param string $object
	 * @param int $objectId
	 * @return Mmi_Dao_Collection
	 */
	public static function findByObjectId($object, $objectId) {
		$q = self::newQuery()
			->where('object')->equals($object)
			->andField('objectId')->equals($objectId)
			->orderAsc('order');
		return self::find($q);
	}

	/**
	 * Dołącza pliki dla danego object i id
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela plików
	 * @return Cms_Model_File_Dao
	 */
	public static function appendFiles($object, $id = null, array $files = array()) {
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
			$record->cms_auth_id = Default_Registry::$auth->getId();
			$record->active = 1;
			$record->save();
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
			$record->cms_auth_id = Default_Registry::$auth->getId();
			$record->active = 1;
			$record->save();
		}
		return true;
	}
	
	/**
	 * Dołącza pliki dla danego object i id przesłane w postaci binarnej
	 * @param string $object obiekt
	 * @param int $id id obiektu
	 * @param array $files tabela nazw plików na serwerze
	 * @return Cms_Model_File_Dao
	 */
	public static function appendFilesFromBinary($object, $id = null, array $files = array()) {
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
			$record->cms_auth_id = Default_Registry::$auth->getId();
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
		$q = self::newQuery()
			->where('object')->equals($srcObject)
			->andField('objectId')->equals($srcId);
		foreach (self::find($q) as $file) {
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