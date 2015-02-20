<?php

class Cms_Controller_Cron extends Mmi_Controller_Action {
	
	public function indexAction() {
		Cms_Model_Cron_Job::run();
		return 'OK';
	}
	
	public function sendMailAction() {
		if (rand(0, 120) == 12) {
			$this->view->cleared = Cms_Model_Mail_Dao::clean();
		}
		$this->view->result = Cms_Model_Mail_Dao::send();
	}
	
	public function agregateAction() {
		$this->view->result = Cms_Model_Stat_Dao::agregate();
	}

	public function cleanAction() {
		$months = 24;
		if ($this->months > 0) {
			$months = intval($this->months);
		}
		$this->view->result = Cms_Model_Log_Dao::clean($months);
	}

}
