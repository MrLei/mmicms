<?php

/**
 * @property integer $id
 * @property string $title
 * @property string $serial
 * @property string $uri
 * @property integer $cms_container_template_id
 */
class Cms_Model_Container_Record extends Mmi_Dao_Record {

	public function save() {
		$uf = new Mmi_Filter_Url();
		$this->uri = $uf->filter($this->title);
		$result = parent::save();
		Default_Registry::$cache->remove('Cms_Container_' . $this->uri);
		return $result;
	}

	public function getLeftBoxes($parseParams = true) {
		return $this->_getBoxes('left', $parseParams);
	}

	public function getRightBoxes($parseParams = true) {
		return $this->_getBoxes('right', $parseParams);
	}

	public function getText() {
		if (!$this->serial) {
			return;
		}
		$serial = unserialize($this->serial);
		return isset($serial['text']) ? $serial['text'] : null;
	}

	public function getLead() {
		if (!$this->serial) {
			return;
		}
		$serial = unserialize($this->serial);
		return isset($serial['lead']) ? $serial['lead'] : null;
	}

	protected function _getBoxes($type, $parseParams = true) {
		if (!$this->serial) {
			return array();
		}
		$serial = unserialize($this->serial);
		$boxes = array();
		foreach ($serial[$type] as $id => $box) {
			$boxId = isset($box['box']) ? $box['box'] : null;
			if ($parseParams) {
				parse_str(isset($box['params']) ? $box['params'] : '', $params);
				$params['type'] = isset($params['type']) ? $params['type'] : 'slide';

				$params['module'] = isset($params['module']) ? $params['module'] : 'box';
				$params['controller'] = isset($params['controller']) ? $params['controller'] : 'index';
				$params['action'] = isset($params['action']) ? $params['action'] : $params['type'];

				$params['width'] = isset($params['width']) ? $params['width'] : '240';
				$params['height'] = isset($params['height']) ? $params['height'] : '100';
				$params['imageWidth'] = isset($params['imageWidth']) ? $params['imageWidth'] : $params['width'];
				$params['imageHeight'] = isset($params['imageHeight']) ? $params['imageHeight'] : $params['height'];
				$params['id'] = $boxId;
			} else {
				$params = isset($box['params']) ? $box['params'] : '';
			}
			$boxes[$id] = array('box' => $boxId, 'params' => $params);
		}
		return $boxes;
	}

	public function delete() {
		Default_Registry::$cache->remove('Cms_Container_' . $this->uri);

		$container = Cms_Model_Navigation_Dao::findFirstByArticleUri($this->uri);

		if ($container !== null) {
			$container->delete();
		}
		return parent::delete();
	}

}