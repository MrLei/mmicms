<?php

class Cms_Model_Container_Template_Placeholder_Container_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $cms_container_id;

	/**
	 *
	 * @var integer
	 */
	public $cms_container_template_placeholder_id;

	/**
	 *
	 * @var string
	 */
	public $module;

	/**
	 *
	 * @var string
	 */
	public $controller;

	/**
	 *
	 * @var string
	 */
	public $action;

	/**
	 *
	 * @var string
	 */
	public $params;

	/**
	 *
	 * @var int
	 */
	public $marginTop;

	/**
	 *
	 * @var int
	 */
	public $marginLeft;

	/**
	 *
	 * @var int
	 */
	public $marginRight;

	/**
	 *
	 * @var int
	 */
	public $marginBottom;

	/**
	 *
	 * @var boolean
	 */
	public $active;

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
