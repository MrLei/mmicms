<?php

class Cms_Model_Navigation_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_navigation';

	/**
	 * 
	 * @return Cms_Model_Navigation_Query
	 */
	public static function langQuery() {
		if (!Mmi_Controller_Front::getInstance()->getRequest()->lang) {
			return Cms_Model_Navigation_Query::factory();
		}
		return Cms_Model_Navigation_Query::factory()
				->andQuery(Cms_Model_Navigation_Query::factory()
					->whereLang()->equals(Mmi_Controller_Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}

	/**
	 * 
	 * @param string $uri
	 * @return Cms_Model_Navigation_Query
	 */
	public static function byArticleUriQuery($uri) {
		return Cms_Model_Navigation_Query::factory()
				->whereModule()->equals('cms')
				->andFieldController()->equals('article')
				->andFieldAction()->equals('index')
				->andFieldParams()->equals('uri=' . $uri);
	}

	/**
	 * 
	 * @param type $parentId
	 * @return Cms_Model_Navigation_Query
	 */
	public static function byParentIdQuery($parentId) {
		return Cms_Model_Navigation_Query::factory()
				->whereParentId()->equals($parentId);
	}

	/**
	 * 
	 * @param type $parentId
	 * @return Cms_Model_Navigation_Query
	 */
	public static function descByParentIdQuery($parentId) {
		return self::byParentIdQuery($parentId)
				->orderDescOrder();
	}

	/**
	 * 
	 * @return array
	 */
	public static function getMultiOptions() {
		return array(null => '---') + self::langQuery()
				->orderAscParentId()
				->orderAscOrder()->findPairs('id', 'label');
	}

	/**
	 * Dodaje do konfiguracji dane z bazy danych
	 * @param Mmi_Navigation_Config $config
	 */
	public static function decorateConfiguration(Mmi_Navigation_Config $config) {
		$objectArray = self::langQuery()
			->orderAscParentId()
			->orderAscOrder()
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

}
