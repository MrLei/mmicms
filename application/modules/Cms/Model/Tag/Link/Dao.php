<?php

class Cms_Model_Tag_Link_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_tag_link';
	protected static $_tagJoinSchema = array('cms_tag' => array('id', 'cms_tag_id'));

	//@TODO: usunąć jeśli już nieużywany
	public static function link($objectId, array $tags, $objectType) {
		self::find(array(array('objectId', $objectId), array('object', $objectType)))->delete();
		foreach ($tags as $tagId) {
			$record = new Cms_Model_Tag_Link_Record();
			$record->cms_tag_id = $tagId;
			$record->objectId = $objectId;
			$record->object = $objectType;
			$record->save();
		}
	}

	//@TODO: usunąć jeśli już nieużywany
	public static function unlink($objectId, $objectType) {
		self::find(array(array('objectId', $objectId), array('object', $objectType)))->delete();
	}

	/**
	 * Taguje tagiem po identyfikatorze
	 * @param int $tagId identyfikator taga
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function tag($tagId, $object, $objectId = null) {
		try {
			$record = new Cms_Model_Tag_Link_Record();
			$record->cms_tag_id = $tagId;
			$record->object = $object;
			$record->objectId = $objectId;
			return $record->save();
		} catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * Taguje tagiem po nazwie
	 * @param string $tagName nazwa tagu
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function namedTag($tagName, $object, $objectId = null) {
		$tag = Cms_Model_Tag_Dao::findFirstByName(trim($tagName));
		if ($tag === null) {
			return false;
		}
		return self::tag($tag->id, $object, $objectId);
	}
	
	/**
	 * Usuwa tag po id
	 * @param int $tagId identyfikator taga
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function unTag($tagId, $object, $objectId = null) {
		return self::find(array(
			array('cms_tag_id', $tagId),
			array('object', $object),
			array('objectId', $objectId)
		))->delete();
	}

	/**
	 * Usuwa tag po nazwie
	 * @param string $tagName nazwa tagu
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function unNamedTag($tagName, $object, $objectId = null) {
		$tag = Cms_Model_Tag_Dao::findFirstByName(trim($tagName));
		if ($tag === null) {
			return false;
		}
		return self::unTag($tag->id, $object, $objectId);
	}
	
	/**
	 * Czyszczenie tagów
	 * @param string $object obiekt
	 * @param int $objectId id obiektu
	 * @return int ilość usuniętych
	 */
	public static function clearTags($object, $objectId = null) {
		return self::find(array(
			array('object', $object),
			array('objectId', $objectId)
		))->delete();
	}

	/**
	 * Zamiana tagów na podstawie tablicy identyfikatorów
	 * @param array $tags tablica identyfikatorów tagów
	 * @param string $object obiekt
	 * @param int $objectId id obiektu
	 * @return boolean
	 */
	public static function replaceTags(array $tagIds, $object, $objectId = null) {
		self::clearTags($object, $objectId);
		$result = true;
		foreach ($tagIds as $tagId) {
			$result = $result && self::tag($tagId, $object, $objectId);
		}
		return $result;
	}

	/**
	 * Zmiana tagów na podstawie tablicy nazw tagów
	 * @param array $tagNames
	 * @param type $object
	 * @param type $objectId
	 * @return boolean
	 */
	public static function replaceNamedTags(array $tagNames, $object, $objectId = null) {
		$tagIds = array();
		foreach ($tagNames as $tagName) {
			$tag = Cms_Model_Tag_Dao::findFirstByName(trim($tagName));
			//tworzy tag jeśli jeszcze nie utworzony
			if ($tag == null) {
				$tag = new Cms_Model_Tag_Record();
				$tag->tag = $tagName;
				$tag->save();
			}
			$tagIds[] = $tag->id;
		}
		return self::replaceTags($tagIds, $object, $objectId);
	}
	
	/**
	 * Znajduje tagi
	 * @param type $object 
	 * @param type $objectId
	 * @return Mmi_Dao_Record_Collection
	 */
	public static function findTags($object, $objectId = null) {
		return self::find(array(
			array('object', $object),
			array('objectId', $objectId)
		), array('tag', 'ASC', 'cms_tag'), null, null, self::$_tagJoinSchema);
	}
	
	public static function getTagString($object, $objectId) {
		$tagString = '';
		foreach (self::findTags($object, $objectId) as $tag) {
			$tagString .= $tag->tag . ',';
		}
		return trim($tagString, ', ');
	}

}