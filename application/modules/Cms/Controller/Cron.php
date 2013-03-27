<?php

class Cms_Controller_Cron extends Mmi_Controller_Action {
	
	public function cleanAction() {
		$this->view->result = Cms_Model_Log_Dao::clean();
	}
	
}
