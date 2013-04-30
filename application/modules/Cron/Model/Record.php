<?php

class Cron_Model_Record extends Mmi_Dao_Record {

	public function save() {
		if ($this->object) {
			$params = explode('_', $this->object);
			if (count($params) == 3) {
				$this->module = $params[0] != 'default' ? $params[0] : null;
				$this->controller = $params[1];
				$this->action = $params[2];
			} else {
				$this->module = null;
				$this->controller = null;
				$this->action = null;
			}
		}
		$this->dateModified = date('Y-m-d H:i:s');
		return parent::save();
	}	

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		return parent::_insert();
	}

}
