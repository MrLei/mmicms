<?php

class Cron_Controller_Index extends Mmi_Controller_Action {

	public function runAction() {
		Cron_Model_Job::run();
		return 'Done.';
	}

}
