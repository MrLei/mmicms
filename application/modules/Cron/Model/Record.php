<?php

/**
 * @property integer $id
 * @property integer $active
 * @property string $minute
 * @property string $hour
 * @property string $dayOfMonth
 * @property string $month
 * @property string $dayOfWeek
 * @property string $name
 * @property string $description
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $dateAdd
 * @property string $dateModified
 * @property string $dateLastExecute
 */
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
