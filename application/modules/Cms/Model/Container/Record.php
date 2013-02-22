<?php

class Cms_Model_Container_Record extends Mmi_Dao_Record {

	public function save() {
		$data = $this->toArray();
		$boxes = array('left' => array(), 'right' => array());
		foreach ($data as $field => $value) {
			if (preg_match('/(left|right)\-box\-([0-9]+)-?(params)?/', $field, $found)) {
				if ($value === null || $value == '') {
					continue;
				}
				$boxes[$found[1]][$found[2]][isset($found[3]) ? 'params' : 'box'] = $value;
			}
		}
		$boxes['text'] = $this->text;
		$boxes['lead'] = $this->lead;
		$this->serial = serialize($boxes);
		$filter = new Mmi_Filter_Url();
		$this->uri = strtolower($filter->filter($this->title));
		$result = parent::save();
		Mmi_Cache::getInstance()->remove('Cms_Container_' . $this->uri);
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
		$container = Cms_Model_Navigation_Dao::findFirst(array(
				array('module', 'cms'),
				array('controller', 'container'),
				array('action', 'index'),
				array('params', 'uri=' . $this->uri)
		));
		if ($container !== null) {
			$container->delete();
		}
		return parent::delete();
	}

}