<?php

class Cms_Model_Navigation_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_navigation';

	public static function findFirstByArticleUri($uri) {
		return Cms_Model_Navigation_Query::factory()
				->whereModule()->equals('cms')
				->andFieldController()->equals('article')
				->andFieldAction()->equals('index')
				->andFieldParams()->equals('uri=' . $uri)
				->findFirst();
	}

	public static function findLastByParentId($parentId) {
		$q = self::newQuery()
			->where('parent_id')->equals($parentId)
			->orderDesc('order');
		return self::findFirst($q);
	}

	public static function findByParentId($parentId) {
		$q = self::newQuery()
				->where('parent_id')->equals($parentId);
		return self::find($q);
	}

	public static function getMultiOptions() {
		$q = self::newQuery()
			->orderAsc('parent_id')
			->orderAsc('order');
		self::_langQuery($q);
		return array(null => '---') + self::findPairs('id', 'label', $q);
	}

	/**
	 * Dodaje do konfiguracji dane z bazy danych
	 * @param Mmi_Navigation_Config $config
	 */
	public static function decorateConfiguration(Mmi_Navigation_Config $config) {
		$objectArray = self::_langQuery(Cms_Model_Navigation_Query::factory()
				->orderAscParentId()
				->orderAscOrder()
			)
			->find()
			->toObjectArray();
		foreach ($objectArray as $key => $record) {/* @var $record Cms_Model_Navigation_Record */
			if ($record->parentId != 0) {
				continue;
			}
			$element = Mmi_Navigation_Config::newElement($record->id);
			self::_setNavigationElementFromRecord($record, $element);
			$config->addElement($element);
			unset($objectArray[$key]);
			self::_buildChildren($record, $element, $objectArray);
		}
	}

	/**
	 * Sortuje po zserializowanej tabeli identyfikatorów
	 * @param array $serial tabela identyfikatorów
	 * @return bool
	 */
	public static function sortBySerial(array $serial = array()) {
		foreach ($serial as $order => $id) {
			$record = new Cms_Model_Navigation_Record();
			$record->setNew(false);
			$record->id = $id;
			$record->order = $order;
			$record->save();
		}
		return true;
	}

	protected static function _buildChildren(Cms_Model_Navigation_Record $record, Mmi_Navigation_Config_Element $element, array $objectArray) {
		foreach ($objectArray as $key => $child) {/* @var $child Cms_Model_Navigation_Record */
			if ($child->parentId != $record->id) {
				continue;
			}
			$childElement = Mmi_Navigation_Config::newElement($child->id);
			self::_setNavigationElementFromRecord($child, $childElement);
			$element->addChild($childElement);
			unset($objectArray[$key]);
			self::_buildChildren($child, $childElement, $objectArray);
		}
	}

	protected static function _setNavigationElementFromRecord(Cms_Model_Navigation_Record $record, Mmi_Navigation_Config_Element $element) {
		$https = null;
		if ($record->https === 0) {
			$https = false;
		} elseif ($record->https === 1) {
			$https = true;
		}

		$params = array();
		parse_str($record->params, $params);

		$element
			->setAbsolute($record->absolute ? true : false)
			->setAction($record->action ? : null)
			->setBlank($record->blank ? true : false)
			->setController($record->controller ? : null)
			->setDateEnd($record->dateEnd ? : null)
			->setDateStart($record->dateStart ? : null)
			->setDescription($record->description ? : null)
			->setDisabled($record->active ? false : true)
			->setHttps($https)
			->setIndependent($record->independent ? : null)
			->setKeywords($record->keywords ? : null)
			->setLabel($record->label ? : null)
			->setLang($record->lang ? : null)
			->setModule($record->module ? : null)
			->setNofollow($record->nofollow ? : null)
			->setParams($params)
			->setTitle($record->title ? : null)
			->setUri($record->uri ? : null)
			->setVisible($record->visible ? true : false)
		;
		return $element;
	}

	protected static function _langQuery(Mmi_Dao_Query $q) {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return $q;
		}
		$subQ = Cms_Model_Navigation_Query::factory()
			->where('lang')->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
			->orField('lang')->equals(null)
			->orderDesc('lang');
		return $q->andQuery($subQ);
	}

}
