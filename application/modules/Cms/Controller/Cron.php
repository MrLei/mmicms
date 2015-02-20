<?php


namespace Cms\Controller;

class Cron extends \Mmi\Controller\Action {
	
	public function indexAction() {
		Cms\Model\Cron\Job::run();
		return 'OK';
	}
	
	public function sendMailAction() {
		if (rand(0, 120) == 12) {
			$this->view->cleared = Cms\Model\Mail\Dao::clean();
		}
		$this->view->result = Cms\Model\Mail\Dao::send();
	}
	
	public function agregateAction() {
		$this->view->result = Cms\Model\Stat\Dao::agregate();
	}

	public function cleanAction() {
		$months = 24;
		if ($this->months > 0) {
			$months = intval($this->months);
		}
		$this->view->result = Cms\Model\Log\Dao::clean($months);
	}

}
