<?php
class Mail_Controller_Cron extends Mmi_Controller_Action {

	public function sendAction() {
		if (rand(0, 120) == 12) {
			$this->view->cleared = Mail_Model_Dao::clean();
		}
		$this->view->result = Mail_Model_Dao::send();
	}

}