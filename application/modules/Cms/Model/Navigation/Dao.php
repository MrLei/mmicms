<?php

/**
 * @static-method \Cms\Model\Navigation\Record findPk() findPk($id)
 */

namespace Cms\Model\Navigation;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_navigation';

	/**
	 * 
	 * @return \Cms\Model\Navigation\Query
	 */
	public static function langQuery() {
		if (!\Mmi\Controller\Front::getInstance()->getRequest()->lang) {
			return \Cms\Model\Navigation\Query::factory();
		}
		\Cms\Model\Navigation\Query::factory();
		return \Cms\Model\Navigation\Query::factory()
				->andQuery(\Cms\Model\Navigation\Query::factory()
					->whereLang()->equals(\Mmi\Controller\Front::getInstance()->getRequest()->lang)
					->orFieldLang()->equals(null)
					->orderDescLang());
	}

	/**
	 * 
	 * @param string $uri
	 * @return \Cms\Model\Navigation\Query
	 */
	public static function byArticleUriQuery($uri) {
		return \Cms\Model\Navigation\Query::factory()
				->whereModule()->equals('cms')
				->andFieldController()->equals('article')
				->andFieldAction()->equals('index')
				->andFieldParams()->equals('uri=' . $uri);
	}

	/**
	 * 
	 * @param type $parentId
	 * @return \Cms\Model\Navigation\Query
	 */
	public static function byParentIdQuery($parentId) {
		return \Cms\Model\Navigation\Query::factory()
				->whereParentId()->equals($parentId);
	}

	/**
	 * 
	 * @param type $parentId
	 * @return \Cms\Model\Navigation\Query
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
	 * @param \Mmi\Navigation\Config $config
	 */
	public static function decorateConfiguration(\Mmi\Navigation\Config $config) {
		$objectArray = self::langQuery()
			->orderAscParentId()
			->orderAscOrder()
			->find()
			->toObjectArray();
		foreach ($objectArray as $key => $record) {/* @var $record \Cms\Model\Navigation\Record */
			if ($record->parentId != 0) {
				continue;
			}
			$element = \Mmi\Navigation\Config::newElement($record->id);
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
			$record = \Cms\Model\Navigation\Query::factory()->findPk($id);
			if (!$record) {
				continue;	
			}
			$record->order = $order;
			$record->save();
		}
		return true;
	}

	protected static function _buildChildren(\Cms\Model\Navigation\Record $record, \Mmi\Navigation\Config\Element $element, array $objectArray) {
		foreach ($objectArray as $key => $child) {/* @var $child \Cms\Model\Navigation\Record */
			if ($child->parentId != $record->id) {
				continue;
			}
			$childElement = \Mmi\Navigation\Config::newElement($child->id);
			self::_setNavigationElementFromRecord($child, $childElement);
			$element->addChild($childElement);
			unset($objectArray[$key]);
			self::_buildChildren($child, $childElement, $objectArray);
		}
	}

	protected static function _setNavigationElementFromRecord(\Cms\Model\Navigation\Record $record, \Mmi\Navigation\Config\Element $element) {
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
