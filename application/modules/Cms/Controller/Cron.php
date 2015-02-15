<?php

class Cms_Controller_Cron extends Mmi_Controller_Action {
	
	public function indexAction() {
		Cms_Model_Cron_Job::run();
		return 'OK';
	}

	public function cleanAction() {
		$months = 24;
		if ($this->months > 0) {
			$months = intval($this->months);
		}
		$this->view->result = Cms_Model_Log_Dao::clean($months);
	}

}
