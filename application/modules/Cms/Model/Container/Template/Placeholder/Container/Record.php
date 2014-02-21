<?php

/**
 * @property integer $id
 * @property integer $cms_container_id
 * @property integer $cms_container_template_placeholder_id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $params
 * @property int $marginTop
 * @property int $marginLeft
 * @property int $marginRight
 * @property int $marginBottom
 * @property boolean $active
 */
class Cms_Model_Container_Template_Placeholder_Container_Record extends Mmi_Dao_Record {

	public function save() {
		$object = explode('_', $this->object);
		unset($this->object);
		$this->module = isset($object[0]) ? $object[0] : 'default';
		$this->controller = isset($object[1]) ? $object[1] : 'index';
		$this->action = isset($object[2]) ? $object[2] : 'index';
		$this->marginTop = ($this->marginTop == '') ? null : $this->marginTop;
		$this->marginRight = ($this->marginRight == '') ? null : $this->marginRight;
		$this->marginBottom = ($this->marginBottom == '') ? null : $this->marginBottom;
		$this->marginLeft = ($this->marginLeft == '') ? null : $this->marginLeft;
		return parent::save();
	}

}