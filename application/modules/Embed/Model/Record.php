<?php

class Embed_Model_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $encodedId;

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

	public function save() {
		if (!$this->encodedId) {
			$this->encodedId = 100000000 + rand(0, 899999999);
		}
		if ($this->object) {
			$object = explode('_', $this->object);
			$this->module = $object[0];
			$this->controller = $object[1];
			$this->action = $object[2];
		}
		return parent::save();
	}

}
