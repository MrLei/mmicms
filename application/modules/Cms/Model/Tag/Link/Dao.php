<?php


namespace Cms\Model\Tag\Link;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_tag_link';

	/**
	 * Taguje tagiem po identyfikatorze
	 * @param int $tagId identyfikator taga
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function tag($tagId, $object, $objectId = null) {
		try {
			$record = new \Cms\Model\Tag\Link\Record();
			$record->cmsTagId = $tagId;
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
		$tag = \Cms\Model\Tag\Dao::byNameQuery(trim($tagName))
			->findFirst();
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
		return \Cms\Model\Tag\Link\Query::factory()
				->whereCmsTagId()->equals($tagId)
				->andFieldObject()->equals($object)
				->andFieldObjectId()->equals($objectId)
				->find()
				->delete();
	}

	/**
	 * Usuwa tag po nazwie
	 * @param string $tagName nazwa tagu
	 * @param string $object obiekt
	 * @param int $objectId identyfikator obiektu
	 * @return boolean
	 */
	public static function unNamedTag($tagName, $object, $objectId = null) {
		$tag = \Cms\Model\Tag\Dao::byNameQuery(trim($tagName))
			->findFirst();
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
		return \Cms\Model\Tag\Link\Query::factory()
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId)
				->find()
				->delete();
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
			$tag = \Cms\Model\Tag\Dao::byNameQuery(trim($tagName))
				->findFirst();
			//tworzy tag jeśli jeszcze nie utworzony
			if ($tag == null) {
				$tag = new \Cms\Model\Tag\Record();
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
	 * @return \Mmi\Dao\Record\Collection
	 */
	public static function tagsByObjectQuery($object, $objectId = null) {
		return \Cms\Model\Tag\Link\Query::factory()
				->join('cms_tag')->on('cms_tag_id')
				->whereObject()->equals($object)
				->andFieldObjectId()->equals($objectId)
				->orderAsc('tag', 'cms_tag');
	}

	public static function getTagString($object, $objectId) {
		$tagString = '';
		foreach (self::tagsByObjectQuery($object, $objectId)->find() as $tag) {
			$tagString .= $tag->getJoined('cms_tag')->tag . ',';
		}
		return trim($tagString, ', ');
	}

}
