<?php

class Stat_Controller_Cron extends Mmi_Controller_Action {

	public function agregateAction() {
		$this->view->result = Stat_Model_Dao::agregate();
	}

}