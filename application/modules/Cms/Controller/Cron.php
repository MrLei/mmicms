<?php

class Cms_Controller_Cron extends Mmi_Controller_Action {
	
	public function cleanAction() {
		$months = 24;
		if ($this->_getParam('months') > 0) {
			$months = intval($this->_getParam('months'));
		}
		$this->view->result = Cms_Model_Log_Dao::clean($months);
	}
	
}
