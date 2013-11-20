<?php

class Cms_Model_Navigation_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_navigation';

	/**
	 * Obiekt struktury zagnieżdżonej
	 * @var Mmi_Nested
	 */
	protected static $_nested;

	public static function findFirstByArticleUri($uri) {
		$q = self::newQuery()
				->where('module')->eqals('cms')
				->andField('controller')->eqals('article')
				->andField('action')->eqals('index')
				->andField('params')->eqals('uri=' . $uri);
		return Cms_Model_Navigation_Dao::findFirst($q);
	}

	public static function findLastByParentId($parentId) {
		$q = self::newQuery()
				->where('parent_id')->eqals($parentId)
				->orderDesc('order');
		return Cms_Model_Navigation_Dao::findFirst($q);
	}

	public static function findByParentId($parentId) {
		$q = self::newQuery()
				->where('parent_id')->eqals($parentId);
		return Cms_Model_Navigation_Dao::find($q);
	}

	public static function seek($id) {
		self::_initNested();
		return self::$_nested->seek($id);
	}

	public static function getMultiOptions() {
		self::_initNested(true);
		$multiOptions = array();
		foreach (self::$_nested->flat(self::$_nested->getStructure()) as $leaf) {
			if ($leaf['label'] == '')
				$leaf['label'] = '---';
			$space = '';
			for ($i = 0; $i < $leaf['level']; $i++) {
				$space .= '&nbsp;&nbsp;';
			}
			$space .= '| ';
			$multiOptions[$leaf['id']] = $space . $leaf['label'];
		}
		return $multiOptions;
	}

	public static function getNested() {
		self::_initNested();
		return self::$_nested;
	}

	protected static function _initNested() {
		if (!(self::$_nested instanceof Mmi_Nested)) {
			self::$_nested = new Mmi_Nested(self::_getNestedData());
		}
	}

	protected static function _getNestedData() {
		$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$q = self::newQuery()
			->where('lang')->eqals($lang)
			->orderAsc('parent_id')
			->orderAsc('order');
		$data = self::find($q)->toArray();
		$view = Mmi_View::getInstance();
		foreach ($data as $key => $item) {
			$data[$key]['disabled'] = 0;
			if (isset($item['active']) && ($item['active'] == 0 || ($item['dateStart'] !== null && $item['dateStart'] > date('Y-m-d H:i:s')) || ($item['dateEnd'] !== null && $item['dateEnd'] < date('Y-m-d H:i:s')))) {
				$data[$key]['disabled'] = 1;
			}
			$data[$key]['active'] = 0;
			if (!$item['uri']) {
				$params = array();
				parse_str($item['params'], $params);
				$params['lang'] = $item['lang'];
				if ($item['module'] != '') {
					$data[$key]['type'] = 'cms';
				} else {
					$data[$key]['type'] = 'folder';
				}
				$params['module'] = $item['module'];
				$params['controller'] = $item['controller'] ? $item['controller'] : 'index';
				$params['action'] = $item['action'] ? $item['action'] : 'index';
				$https = null;
				if (array_key_exists('https', $item) && $item['https'] == 1) {
					$https = true;
				}
				if (array_key_exists('https', $item) && $item['https'] == 0) {
					$https = false;
				}
				$absolute = (isset($item['absolute']) && $item['absolute']) ? true : false;
				if ($item['module'] != '') {
					$data[$key]['uri'] = $view->url($params, true, $absolute, $https);
				} else {
					$data[$key]['uri'] = '#';
				}
				$data[$key]['request'] = $params;
			} else {
				if (strpos($data[$key]['uri'], '://') === false && strpos($data[$key]['uri'], '#') !== 0 && strpos($data[$key]['uri'], '/') !== 0) {
					$data[$key]['uri'] = 'http://' . $data[$key]['uri'];
				}
				$data[$key]['type'] = 'link';
			}

			if ($item['uri'] == null && $item['module'] == null && $item['controller'] == null && $item['action'] == null) {
				$data[$key]['type'] = 'folder';
			} elseif ($item['uri'] != null) {
				$data[$key]['type'] = 'link';
			} elseif ($item['module'] == 'cms' && $item['controller'] == 'article' && $item['action'] == 'index') {
				$data[$key]['type'] = 'static';
			} elseif ($item['module'] == 'cms' && $item['controller'] == 'container' && $item['action'] == 'index') {
				$data[$key]['type'] = 'container';
			} else {
				$data[$key]['type'] = 'cms';
			}
		}
		return $data;
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

}
